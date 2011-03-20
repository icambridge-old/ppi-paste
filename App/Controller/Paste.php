<?php
class APP_Controller_Paste extends PPI_Controller {

	protected function _getCouch(){
		
		$objConfig = $this->getConfig();
		$objCouch = new couchClient("http://".$objConfig->db->username.":".
									$objConfig->db->password."@".$objConfig->db->host.":".$objConfig->db->port."/",
									$objConfig->db->dbname);
						
		return $objCouch;					
	}

	function index() {
		$this->redirect("");
	}
	
	
	function submit(){
	
		if ( !$this->isPost() ) {
			$this->redirect("error/nopost");	
		}
		
		$objConfig = $this->getConfig();
		$pasteValues = (object)$this->stripPost("paste_");
		$objCouch = $this->_getCouch();
		
		
		
		try {
											
			if ( !preg_match('~^'.$this->getConfig()->system->base_url.'~isU',$_SERVER['HTTP_REFERER'])  ) {
				throw new Exception("Wrong referer");
			}
			
			if ( $pasteValues->content == "" ){				
				throw new Exception("No paste");
			}
			
			$objResponse = $objCouch->storeDoc($pasteValues);
			$this->redirect("paste/view/id/".$objResponse->id);
		} catch ( Exception $e ) {			
			$this->redirect("error/fail");	
		}	
		
	}	
	
	function view(){
		
		$objCouch = $this->_getCouch();

		$docId = $this->get('id');	
		
		if ( !$docId ){
			$this->load("paste/nopaste");
			return;	
		}
		
		try {			
			$this->load('paste/view', (array) $objCouch->revs_info()->getDoc($docId) );
		} catch ( Exception $e ) {			
			$this->load("paste/nopaste");
			return;	
		}	
		
	}
	
	public function revise(){
		
		
		$objCouch = $this->_getCouch();
		$docId = $this->get('id');	
		$pasteValues = (object)$this->stripPost("paste_");
		
		try {
											
			if ( !preg_match('~^'.$this->getConfig()->system->base_url.'~isU',$_SERVER['HTTP_REFERER'])  ) {
				throw new Exception("Wrong referer");
			}
			
			if ( $pasteValues->content == "" ){				
				throw new Exception("No paste");
			}
			$revision = $objCouch->revs()->getDoc($docId);
			$revision->content = $pasteValues->content;
			
			$objResponse = $objCouch->storeDoc($revision);
			
			$this->redirect("paste/view/id/".$objResponse->id);
		} catch ( Exception $e ) {			
			$this->redirect("error/fail");	
		}	
		
	}
	
	public function diff(){
				
		$objCouch = $this->_getCouch();
		$docId = $this->get('id');	
		$diff = $this->stripPost("diff_");
			
		if ( sizeof($diff['revs']) !== 2 ) {
			$this->redirect("error/fail");				 
		}
		
		if ( $diff['revs'][1][0] == $diff['revs'][2][0] ) {
			$this->redirect("error/same");		
		} else {
			$revs = array(	$diff['revs'][1][0], $diff['revs'][2][0] );
		}
		
		try {
			$docs = $objCouch->open_revs( $revs )->getDoc($docId);
			
			foreach ( $docs as $doc ) {
				if ( !isset($doc->ok) ) {				
					$this->redirect("error/missing");						
				}	
			}	
			
			$this->load('paste/diff', compact('docs'));
	
		} catch ( Exception $e ) {			
			$this->redirect("error/fail");	
		}	
		
	}
}