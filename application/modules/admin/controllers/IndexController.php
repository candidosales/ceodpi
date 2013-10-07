<?php
class Admin_IndexController extends Zend_Controller_Action
{
 	public function init()
    {
   		if (!Zend_Auth::getInstance()->hasIdentity()) {
           // Se o usuário estiver logado, não queremos mostrar o formulário de login;
            if ('logout' != $this->getRequest()->getActionName()) {
                $this->_redirect("admin/auth");
            }
	  	}
    }

	public function indexAction() {
		
		$cliente = new Cliente();		
		$this->view->clientes = $cliente->getTodosClientesAZ();
	  	$this->view->headTitle()->prepend('Painel do Administrador');
	}

}
