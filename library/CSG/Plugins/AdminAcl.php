<?php

class CSG_Plugins_AdminAcl extends Zend_Acl{
	
	public function __construct() {
	/*Papeis = Role = Grupos */
		 //Módulo Admin
        $this->addRole(new Zend_Acl_Role('visitante'));
        $this->addRole(new Zend_Acl_Role('assistente'), 'visitante');
        $this->addRole(new Zend_Acl_Role('administrador')); //Não precisa herdar de nada, pois tem permissão pra tudo

	/* Recursos */
        //Admin
        $this->add(new Zend_Acl_Resource('admin:auth'));
        $this->add(new Zend_Acl_Resource('admin:cliente'));
        $this->add(new Zend_Acl_Resource('admin:certificado'));
        $this->add(new Zend_Acl_Resource('admin:index'));
        $this->add(new Zend_Acl_Resource('admin:usuario'));
        $this->add(new Zend_Acl_Resource('admin:relatorio'));
        $this->add(new Zend_Acl_Resource('admin:sms'));
        $this->add(new Zend_Acl_Resource('default:index'));
        $this->add(new Zend_Acl_Resource('default:cliente'));
		$this->add(new Zend_Acl_Resource('facebook:index'));

    /* Privilégios */
        //allow:permitir / deny:bloquear(negar)
        //Permitir que o Visitante, Acesse Admin->AuthController, pode acessar a Action Index
        $this->allow('visitante', 'default:index',array('index'));
        $this->allow('visitante', 'default:cliente',array('index','ajax-adicionar-cliente','twitter'));

        
        $this->allow('visitante', 'admin:auth',array('logout','index','esqueci-senha'));
        $this->allow('visitante', 'admin:index',array('index','csv','teste'));
        $this->allow('visitante','admin:cliente',array('index','ver','ajax-confirma-pagamento','ajax-datas-relatorio','export-pdf','buscar'));
		$this->allow('visitante', 'admin:relatorio');
		$this->allow('visitante', 'admin:certificado',array('export'));
		$this->deny('visitante', 'admin:usuario','index');
		$this->deny('visitante', 'admin:sms','index');
		$this->deny('visitante', 'admin:relatorio','index');
		
  		$this->allow('assistente','admin:index',array('index'));
        $this->allow('assistente','admin:cliente',array('adicionar'));
        $this->allow('assistente','admin:relatorio');
        $this->deny('assistente', 'admin:auth','index');
       /**
         * Permissões de nível Usuário
         * 
         */
        //Permiti todas as funções
        $this->allow('administrador');

    }
}
