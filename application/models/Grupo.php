<?php

class Grupo extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "GrupoMapper";
    private $nome = null;
    private $usuario_id_criacao = null;
    private $usuario_id_atualizacao = null;
    private $usuario_id_deletado = null;
    private $deletado = null;
 	private $data_deletado = null;
 	private $data_criacao = null;
 	private $data_atualizacao = null;
    
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
    
    public function getDeletado(){
    	return $this->deletado;
    }
    public function setDeletado($deletado){
    	return $this->deletado = $deletado;
    }

 	public function getUsuario_id_criacao(){
    	return $this->usuario_id_criacao;
    }
    public function setUsuario_id_criacao($usuario_id_criacao){
    	return $this->usuario_id_criacao = $usuario_id_criacao;
    }
    
	public function getUsuario_id_atualizacao(){
    	return $this->usuario_id_atualizacao;
    }
    public function setUsuario_id_atualizacao($usuario_id_atualizacao){
    	return $this->usuario_id_atualizacao = $usuario_id_atualizacao;
    }
    
	public function getData_criacao(){
		return $this->data_criacao;
	}
	
	public function setData_criacao($data_criacao){
		$this->data_criacao = $data_criacao;
	}
	
	public function getData_atualizacao(){
		return $this->data_atualizacao;
	}
	
	public function setData_atualizacao($data_atualizacao){
		$this->data_atualizacao = $data_atualizacao;
	}
    
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getGrupos(){
		return  $this->getMapper()->getDb()->fetchAll('SELECT g.* from grupo g WHERE g.deletado = 0');
	}
	
	public function getPairs(){
    	return $this->getMapper()->getDb()->fetchPairs('SELECT g.id, g.nome FROM grupo g WHERE g.deletado = 0 ORDER BY g.id ASC');
    }
	
}