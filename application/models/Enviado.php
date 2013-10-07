<?php

class Enviado extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "EnviadoMapper";
    private $sms_id = null;
    private $usuario_id_destinatario = null;
 	private $status = null;
    
	public function setSms_id($sms_id){
		$this->sms_id = $sms_id;
	}
	
	public function getSms_id(){
		return $this->sms_id;
	}
    
    public function getUsuario_id_destinatario(){
    	return $this->usuario_id_destinatario;
    }
    public function setUsuario_id_destinatario($usuario_id_destinatario){
    	return $this->usuario_id_destinatario = $usuario_id_destinatario;
    }
    
	public function getStatus(){
		return $this->status;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
    
	
	public function getEnviado(){
		return  $this->getMapper()->getDb()->fetchAll('SELECT e.* from enviado e');
	}
	
	public function getSMSEnviadosNosXDIas($numero_dias){
		$data_inicial = date('Y-d-m',mktime(0, 0, 0, date("m"),date("d") - $numero_dias, date("Y")));
		
		/*return $this->getMapper()->getDb()->fetchAll('SELECT s.id, s.mensagem, s.data_envio, COUNT(e.id) AS qtd_sms_enviado FROM enviado AS e, sms AS s 
													  WHERE s.id = e.sms_id AND s.data_envio BETWEEN ('.$data_inicial.') AND (curdate()+INTERVAL 1 DAY) GROUP BY s.id');
	    */
		return $this->getMapper()->getDb()->fetchAll('SELECT res.id, res.mensagem, DATE(res.data_envio) AS data_envio, SUM(res.qtd_sms_enviado) AS qtd_sms_enviado FROM 
													 (SELECT s.id, s.mensagem, s.data_envio, COUNT(e.id) AS qtd_sms_enviado FROM enviado AS e, sms AS s
													  WHERE s.id = e.sms_id AND s.data_envio BETWEEN ('.$data_inicial.') AND (curdate()+INTERVAL 1 DAY) GROUP BY s.id) AS res GROUP BY DATE(res.data_envio)');
	}
	
}