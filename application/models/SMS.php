<?php

class SMS extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "SMSMapper";
    private $mensagem = null;
    private $usuario_id_envio = null;
 	private $data_envio = null;
    
	public function setMensagem($mensagem){
		$this->mensagem = $mensagem;
	}
	
	public function getMensagem(){
		return $this->mensagem;
	}
    
    public function getUsuario_id_envio(){
    	return $this->usuario_id_envio;
    }
    public function setUsuario_id_envio($usuario_id_envio){
    	return $this->usuario_id_envio = $usuario_id_envio;
    }
    
	public function getData_envio(){
		return $this->data_envio;
	}
	
	public function setData_envio($data_envio){
		$this->data_envio = $data_envio;
	}
    
	
	public function getSMS(){
		return  $this->getMapper()->getDb()->fetchAll('SELECT s.* from sms s');
	}
	
}