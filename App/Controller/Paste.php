<?php
class APP_Controller_Paste extends PPI_Controller {

	public function index() {
		
	}
	
	
	public function submit(){
	
		// Not a post therefore fuck off :D
		if ( !$this->isPost() ) {
			$this->redirect("Error/nopost");	
		}
		
		$pasteValues = (object)$this->stripPost("paste_");
		$objConfig = $this->getConfig();
		
		$objCouch = new couchClient("http://".$objConfig->db->username.":".
									$objConfig->db->password."@".$objConfig->db->host.":".$objConfig->db->port."/",
									$objConfig->db->dbname);
		try {							
			$objResponse = $objCouch->storeDoc($pasteValues);
			$this->redirect("Paste/View/".$objResponse->id);
		} catch ( Exception $e ) {			
			$this->redirect("Error/fail");	
		}	
		
	}	
	
	public function view(){
		
	}
	
}