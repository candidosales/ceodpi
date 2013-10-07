<?php

class TransacaoPagseguro extends CSG_Db_DomainObjectAbstract{

	protected $_mapper = "TransacaoPagseguroMapper";
	
	private $id_transacao = null;
	private $cliente_nome = null;
	private $cliente_id = null;
	private $data_criacao = null;
	private $valor = null;
	
	private $code = null; // string - Retorna o código que identifica a transação de forma única.
	private $reference = null; // string - Informa o código que foi usado para fazer referência ao pagamento. Este código foi fornecido no momento do pagamento e é útil para vincular as transações do PagSeguro
	private $payment_method_type = null; //int - Informa o tipo do meio de pagamento usado pelo comprador. 
	private $payment_method_code = null; // int - O meio de pagamento descreve a bandeira de cartão de crédito utilizada ou banco escolhido para um débito online
	private $sender_email = null; //string - Informa o e-mail do comprador que realizou a transação.
	private $last_event_date = null; //date - Informa o momento em que ocorreu a última alteração no status da transação.
	private $status = null; //int - Informa o código representando o status da transação, permitindo que você decida se deve liberar ou não os produtos ou serviços adquiridos

	public function setLast_event_date($last_event_date){
		$this->last_event_date = $last_event_date;
	}
	
	public function getLast_event_date(){
		return $this->last_event_date;
	}
	
	public function setSender_email($sender_email){
		$this->sender_email = $sender_email;
	}
	
	public function getSender_email(){
		return $this->sender_email;
	}
	
	public function setPayment_method_code($payment_method_code){
		$this->payment_method_code = $payment_method_code;
	}
	
	public function getPayment_method_code(){
		return $this->payment_method_code;
	}
	
	public function setPayment_method_type($payment_method_type){
		$this->payment_method_type = $payment_method_type;
	}
	
	public function getPayment_method_type(){
		return $this->payment_method_type;
	}
	
	public function setReference($reference){
		$this->reference = $reference;
	}
	
	public function getReference(){
		return $this->reference;
	}
	
	public function setCode($code){
		$this->code = $code;
	}
	
	public function getCode(){
		return $this->code;
	}
	

	public function setId_transacao($id_transacao){
		$this->id_transacao = $id_transacao;
	}
	
	public function getId_transacao(){
		return $this->id_transacao;
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function getStatus(){
		return $this->status;
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
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente AS c, transacao_pagseguro AS t WHERE c.deletado=0 AND c.confirma_pagamento = 1 AND c.email = t.email_consumidor AND t.status = 1');
	}

	public function getClientesPeloMoip(){
		return $this->getMapper()->getDb()->fetchAll('SELECT DISTINCT pendentes.*, c.* FROM (SELECT email_consumidor,valor FROM transacao_moip AS t WHERE t.status in (2,3)) AS pendentes, cliente AS c WHERE c.email = pendentes.email_consumidor AND c.confirma_pagamento = 1');
	}

	public function getClientePagoPorEmail($email){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente AS c, transacao_pagseguro AS t WHERE c.deletado=0 AND c.confirma_pagamento = 1 AND t.email_consumidor like "%'.$email.'%" AND t.status = 1 LIMIT 1');
	}
}