<?php
class Usuario extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "UsuarioMapper";
    private $nome = null;
    private $login = null;
    private $senha = null;
    private $regra = null;
    private $email = null;
    private $tel = null;
    private $ultimo_acesso = null;
    private $data_criacao = null;
    private $data_atualizacao = null;
    private $usuario_id_criacao = null;
    private $usuario_id_atualizacao = null;
    private $deletado = null;
    private $usuario_id_deletado = null;
	private $data_deletado = null;
    
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
    
	public function getDeletado() {
        return $this->deletado;
    }
    public function setDeletado($deletado) {
        $this->deletado = $deletado;
    }

	public function getLogin(){
		return $this->login;
	}
	
	public function setLogin($login){
		$this->login = $login;
	}
	
	public function getEmail(){
		return $this->email;
	}
	
	public function setEmail($email){
		$this->email = $email;
	}
	
	public function getNome(){
		return $this->nome;
	}
	
	public function setNome($nome){
		$this->nome = $nome;
	}
	
	public function getTel(){
		return $this->tel;
	}
	
	public function setTel($tel){
		$this->tel = $tel;
	}
	
	public function getRegra()
	{
		return $this->regra;
	}
	public function setRegra($regra)
	{
		$this->regra = $regra;
	}
	
	public function getUltimo_acesso()
	{
		return $this->ultimo_acesso;
	}
	public function setUltimo_acesso($ultimo_acesso)
	{
		$this->ultimo_acesso = $ultimo_acesso;
	}
	
	public function getSenha()
	{
		return $this->senha;
	}
	public function setSenha($senha)
	{
		$this->senha = $senha;
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
	
	public function getUsuarios(){
		return $this->getMapper()->getDb()->fetchAll('SELECT u.* FROM usuario u WHERE u.deletado = 0 ');
	}
	public function getUltimoId(){
		return $this->getMapper()->getDb()->fetchRow('SELECT u.* FROM usuario u WHERE u.deletado = 0  ORDER BY id DESC');
	}
	public function getVerificaLogin($login,$id=null){
			$x=0;
		if(empty($id)){
			if(count($this->getMapper()->getDb()->fetchAll("SELECT u.login FROM usuario u WHERE u.login like '%$login%' AND u.deletado = 0"))>0){
				$x = 1;
			}
		}else{
			if(count($this->getMapper()->getDb()->fetchAll("SELECT u.login FROM usuario u WHERE u.login like '%$login%' AND u.id = $id AND u.deletado = 0"))>0){
				$x = 2;
			}
			if(count($this->getMapper()->getDb()->fetchAll("SELECT u.login FROM usuario u WHERE u.login like '%$login%' AND u.id <> $id AND u.deletado = 0"))>0){
				$x = 3;
			}
		}
		return $x;
	}
}