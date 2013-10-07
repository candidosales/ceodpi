<?php
class Cliente extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "ClienteMapper";
    private $nome = null;
    private $cpf = null;
    private $rg = null;
    private $email = null;
    private $endereco = null;
    private $cidade = null;
    private $estado = null;
    private $pais = null;
    private $cep = null;
    private $tipo = null;
    private $tipo_participacao = null;
    private $filiado = null;
    private $tipo_filiado = null;
    private $instituicao = null;
    private $empresa = null;
    private $celular = null;
    private $twitter = null;
    private $hospedagem = null;
    private $data_nasc = null;
    private $data_inscricao = null;
	private $confirma_pagamento = null;
	private $data_confimar_pagamento = null;
	private $grupo_id = null;
    private $grupo_nome = null;
    private $deletado = null;
    private $usuario_id_deletado = null;
    private $data_deletado = null;
    
    public function setHospedagem($hospedagem){
    	$this->hospedagem = $hospedagem;
    }
    
    public function getHospedagem(){
    	return $this->hospedagem;
    }
	public function setData_deletado($data_deletado){
		$this->data_deletado = $data_deletado;
	}
	
	public function getData_deletado(){
		return $this->data_deletado;
	}
    public function getUsuario_id_deletado(){
    	return $this->usuario_id_deletado;
    }
    public function setUsuario_id_deletado($usuario_id_deletado){
    	return $this->usuario_id_deletado = $usuario_id_deletado;
    }
	public function getDeletado() {
        return $this->deletado;
    }
    public function setDeletado($deletado) {
        $this->deletado = $deletado;
    }
    
	public function getGrupo_id() {
        return $this->grupo_id;
    }
    public function setGrupo_id($grupo_id) {
        $this->grupo_id = $grupo_id;
    }
    
	public function getGrupo_nome() {
        return $this->grupo_nome;
    }
    public function setGrupo_nome($grupo_nome) {
        $this->grupo_nome = $grupo_nome;
    }
    
	public function setTipo_participacao($tipo_participacao){
		$this->tipo_participacao = $tipo_participacao;
	}
	
	public function getTipo_participacao(){
		return $this->tipo_participacao;
	}
    
	public function setCpf($cpf){
		$this->cpf = $cpf;
	}
	public function getCpf(){
		return $this->cpf;
	}
	
	public function setRg($rg){
		$this->rg = $rg;
	}
	public function getRg(){
		return $this->rg;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setTwitter($twitter){
		$this->twitter = $twitter;
	}
	
	public function getTwitter(){
		return $this->twitter;
	}
	
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEndereco($endereco){
		$this->endereco = $endereco;
	}
	
	public function getEndereco(){
		return $this->endereco;
	}
	
	public function setCidade($cidade){
		$this->cidade = $cidade;
	}
	
	public function getCidade(){
		return $this->cidade;
	}
	
	public function setEstado($estado){
		$this->estado = $estado;
	}
	
	public function getEstado(){
		return $this->estado;
	}
	
	public function setPais($pais){
		$this->pais = $pais;
	}
	
	public function getPais(){
		return $this->pais;
	}
	
	public function setCep($cep){
		$this->cep = $cep;
	}
	
	public function getCep(){
		return $this->cep;
	}
	
	public function setTipo($tipo){
		$this->tipo = $tipo;
	}
	
	public function getTipo(){
		return $this->tipo;
	}

	public function setInstituicao($instituicao){
		$this->instituicao = $instituicao;
	}
	
	public function getInstituicao(){
		return $this->instituicao;
	}
	
	public function setEmpresa($empresa){
		$this->empresa = $empresa;
	}
	
	public function getEmpresa(){
		return $this->empresa;
	}
	
	public function setCelular($celular){
		$this->celular = $celular;
	}
	
	public function getCelular(){
		return $this->celular;
	}
	
	public function getData_nasc(){	
		return $this->data_nasc;
	}
	public function setData_nasc($data_nasc){
		$this->data_nasc = $data_nasc;
	}
	
	public function getData_inscricao(){
		return $this->data_inscricao;
	}
	public function setData_inscricao($data_inscricao){
		$this->data_inscricao = $data_inscricao;
	}
	
	public function getConfirma_pagamento(){
		return $this->confirma_pagamento;
	}
	public function setConfirma_pagamento($confirma_pagamento){
		$this->confirma_pagamento = $confirma_pagamento;
	}
	
	public function getData_confirma_pagamento(){
		return $this->data_confirma_pagamento;
	}
	public function setData_confirma_pagamento($data_confirma_pagamento){
		$this->data_confirma_pagamento = $data_confirma_pagamento;
	}
	
	public function getFiliado(){
		return $this->filiado;
	}
	
	public function setFiliado($filiado){
		$this->filiado = $filiado;
	}
	
	public function getTipo_filiado(){
		return $this->tipo_filiado;
	}
	
	public function setTipo_filiado($tipo_filiado){
		$this->tipo_filiado = $tipo_filiado;
	}
	
	public function getClientes(){
		return $this->getMapper()->getDb()->fetchAll('SELECT c.* from cliente c WHERE c.deletado = 0 ');
	}
	
	public function getClientePorEmail($email){
		return $this->getMapper()->getDb()->fetchAll('SELECT c.* FROM cliente c WHERE c.email like "%'.$email.'%" ');
	}
	
	public function getClientePorCpf($cpf){
		return $this->getMapper()->getDb()->fetchAll('SELECT c.* FROM cliente c WHERE c.cpf like "%'.$cpf.'%" ');
	}
	
	public function getClientesInscritosNosXDIas($numero_dias){
		$data_inicial = date('Y-d-m',mktime(0, 0, 0, date("m"),date("d") - $numero_dias, date("Y")));

		return $this->getMapper()->getDb()->fetchAll('SELECT DATE(c.data_inscricao) AS data_inscricao , COUNT(c.id) AS qtd_clientes_inscritos FROM cliente AS c
													  WHERE c.deletado=0 AND c.data_inscricao BETWEEN ('.$numero_dias.') AND (curdate()+INTERVAL 1 DAY) GROUP BY DATE(c.data_inscricao)');
	
	}
	
	public function getClientesPagosNosXDIas($numero_dias){
		$data_inicial = date('Y-d-m',mktime(0, 0, 0, date("m"),date("d") - $numero_dias, date("Y")));

		return $this->getMapper()->getDb()->fetchAll('SELECT DATE(c.data_confirma_pagamento) AS data_pagamento , COUNT(c.id) AS qtd_clientes_pagos FROM cliente AS c
													  WHERE c.data_confirma_pagamento BETWEEN ('.$numero_dias.') AND (curdate()+INTERVAL 1 DAY) AND c.deletado=0 AND confirma_pagamento = 1  GROUP BY DATE(c.data_confirma_pagamento)');
	
	}
	
	public function getClientesPagosEInscritosNosXDias($numero_dias){
		
		return $this->getMapper()->getDb()->fetchAll('select DATE(data_inscricao) AS data_inscricao,
	sum(case when confirma_pagamento=1 then 1 else 0 end) qtd_clientes_pagos,
	sum(case when data_inscricao<>"" then 1 else 0 end) qtd_clientes_inscritos
														from cliente
														where data_inscricao BETWEEN ('.$numero_dias.') AND (curdate()+INTERVAL 1 DAY)
														group by DATE(data_inscricao)');
	}
	
	public function getTotalClientesNaoPagos(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS nao_pagos FROM cliente c WHERE c.deletado=0 AND c.confirma_pagamento = 0');
	}
	
	public function getTotalClientesPagos(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS pagos FROM cliente c WHERE c.deletado=0 AND c.confirma_pagamento = 1');
	}
	
	public function getTotalClientesInscritos(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS inscritos FROM cliente c WHERE c.deletado=0 ');
	}

	public function getTodosClientesAZ(){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente WHERE deletado=0 ORDER BY nome ASC');
	}
	public function getTodosClientesPagosAZ(){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente WHERE deletado=0 AND confirma_pagamento=1 ORDER BY nome ASC');
	}
	public function getTodosClientesNaoPagosAZ(){
		return $this->getMapper()->getDb()->fetchAll('SELECT * FROM cliente WHERE deletado=0 AND confirma_pagamento=0 ORDER BY nome ASC');
	}
	
	public function getClientesByGrupos(){
		return $this->getMapper()->getDb()->fetchAll('SELECT c.id, c.nome, c.grupo_id FROM cliente c WHERE c.deletado=0 ORDER BY c.grupo_id, c.nome ASC');
	}
	
	public function getGruposComClientes(){
		return $this->getMapper()->getDb()->fetchAll('SELECT c.grupo_id, count(c.grupo_id) AS qtd, c.grupo_nome FROM cliente c WHERE c.deletado=0 GROUP BY c.grupo_id ORDER BY c.grupo_id ASC');
	}
	
	public function getTotalApoio(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS apoio FROM cliente WHERE tipo_participacao like "%apoio%" AND deletado=0');	
	}
	
	public function getTotalImprensa(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS imprensa FROM cliente WHERE tipo_participacao like "%imprensa%" AND deletado=0');	
	}
	
	public function getTotalConvite(){
		return $this->getMapper()->getDb()->fetchRow('SELECT COUNT(*) AS convite FROM cliente WHERE tipo_participacao like "%convite%" AND deletado=0');	
	}
	
	public function getPesquisar($nome=null,$cpf=null,$email=null,$twitter=null){
	/*$numero_processo=null, $feito=null, $nome_cliente=null, $competencia=null, $vara=null,
							  $turma=null,$localizacao=null,$comarca=null,$estado=null, $data1=null, $data2=null) {*/
		
		$select = $this->getMapper()->getDbTable()->select()->distinct(true)->where('deletado=0');

		if(!empty($nome)) 
	  		$select->where("nome LIKE '%$nome%'");
	  		
	  	if(!empty($cpf)) 
	  		$select->where("cpf LIKE '%$cpf%'");
	  		
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
	 
	 public function getTotalCatPorEstado(){
	 	return (array) $this->getMapper()->getDb()->fetchAll('select estado,
														       sum(case when tipo=1 then 1 else 0 end) tipo1,
														       sum(case when tipo=2 then 1 else 0 end) tipo2
														from cliente
														group by estado');
	 }

}