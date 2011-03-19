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
		
		$pasteValues = (object)$this->stripPost("paste_");
		$objCouch = $this->_getCouch();
		
		try {							
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
			$this->load('paste/view', (array) $objCouch->getDoc($docId));
		} catch ( Exception $e ) {			
			$this->load("paste/nopaste");
			return;	
		}
		
		
		
	}
	
}