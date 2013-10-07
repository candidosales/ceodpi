<?php
class DbTable_Cliente extends Zend_Db_Table_Abstract
{
    protected $_name = 'cliente';
    protected $_primary = 'id';
    
    
	public function getPesquisar($nome=null,$cpf=null,$rg=null,$email=null,$twitter=null){
	
		$select = $this->select()->distinct(true)->where('deletado=0');

		if(!empty($nome)) 
	  		$select->where("nome LIKE '%$nome%'");
	  		
	  	if(!empty($cpf)) 
	  		$select->where("cpf LIKE '%$cpf%'");
	  	
	  	if(!empty($rg)) 
	  		$select->where("rg = '$rg'");
	  		
	  	if(!empty($email)) 
	  		$select->where("email LIKE '%$email%'");
	  		
	  	if(!empty($twitter)) 
	  		$select->where("twitter LIKE '%$twitter%'");		
	  		
	  	/*if( !empty($date1) and !empty($date2) ) 
  		    $select->where("data_criacao BETWEEN '$date1' AND '$date2'");*/
	  	
  		$select->order('nome ASC');
  		//$select->limit(50);	
  		//echo $select;die;
  		//Zend_Debug::dump($select);die;
  		return $this->fetchAll($select);
	 }
	 
	 public function getPesquisarTodos($data){
	 	$select = $this->select()->distinct(true);

	 	foreach($data as $d){
	 		$select->orWhere("endereco LIKE '%$d%'");
	 		$select->orWhere("nome LIKE '%$d%'");
	 		$select->orWhere("cpf LIKE '%$d%'");
	 		$select->orWhere("rg LIKE '%$d%'");
	 		$select->orWhere("instituicao LIKE '%$d%'");
	 		$select->orWhere("empresa LIKE '%$d%'");
	 		$select->orWhere("email LIKE '%$d%'");
	 		$select->orWhere("celular LIKE '%$d%'");
	 		$select->orWhere("twitter LIKE '%$d%'");
	 		$select->where('deletado=0');
	 	}

	 	return $this->fetchAll($select);
	 }
    
}