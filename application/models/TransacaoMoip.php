<?php

class TransacaoMoip extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "TransacaoMoipMapper";
    private $id_transacao = null;
    private $cliente_nome = null;
    private $cliente_id = null;
 	private $data_criacao = null;
 	private $valor = null;
 	private $status_pagamento = null;
 	private $cod_moip = null;
 	private $forma_pagamento = null;
 	private $tipo_pagamento = null;
 	private $email_consumidor = null;
 	
	public function setId_transacao($id_transacao){
		$this->id_transacao = $id_transacao;
	}
	
	public function getId_transacao(){
		return $this->id_transacao;
	}
 	
	public function setStatus_pagamento($status_pagamento){
		$this->status_pagamento = $status_pagamento;
	}
	
	public function getStatus_pagamento(){
		return $this->status_pagamento;
	}
	
	public function setCod_moip($cod_moip){
		$this->cod_moip = $cod_moip;
	}
	
	public function getCod_moip(){
		return $this->cod_moip;
	}
	
	public function setForma_pagamento($forma_pagamento){
		$this->forma_pagamento = $forma_pagamento;
	}
	
	public function getForma_pagamento(){
		return $this->forma_pagamento;
	}
	
	public function setTipo_pagamento($tipo_pagamento){
		$this->tipo_pagamento = $tipo_pagamento;
	}
	
	public function getTipo_pagamento(){
		return $this->tipo_pagamento;
	}
	
	public function setEmail_consumidor($email_consumidor){
		$this->email_consumidor = $email_consumidor;
	}
	
	public function getEmail_consumidor(){
		return $this->email_consumidor;
	}
    
	public function setData_criacao($data_criacao){
		$this->data_criacao = $data_criacao;
	}
	
	public function getData_criacao(){
		return $this->data_criacao;
	}
	
	public function setCliente_nome($cliente_nome){
		$this->cliente_nome = $cliente_nome;
	}
	
	public function getCliente_nome(){
		return $this->cliente_nome;
	}
	
	public function setCliente_id($cliente_id){
		$this->cliente_id = $cliente_id;
	}
	
	public function getCliente_id(){
		return $this->cliente_id;
	}
	
	public function setValor($valor){
		$this->valor = $valor;
	}
	
	public function getValor(){
		return $this->valor;
	}

	public function getClientesPagosComMesmoEmail(){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente AS c, transacao_moip AS t WHERE c.deletado=0 AND c.confirma_pagamento = 1 AND c.email = t.email_consumidor AND t.status_pagamento = 1');
	}
	
	public function getClientesPeloMoip(){
		return $this->getMapper()->getDb()->fetchAll('SELECT DISTINCT pendentes.*, c.* FROM (SELECT email_consumidor,valor FROM transacao_moip AS t WHERE t.status_pagamento in (1,6)) AS pendentes, cliente AS c WHERE c.email = pendentes.email_consumidor AND c.confirma_pagamento = 1');
	}
	
	public function getClientePagoPorEmail($email){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente AS c, transacao_moip AS t WHERE c.deletado=0 AND c.confirma_pagamento = 1 AND t.email_consumidor like "%'.$email.'%" AND t.status_pagamento = 1 LIMIT 1');
	}
}