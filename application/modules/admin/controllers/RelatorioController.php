<?php
class Admin_RelatorioController extends Zend_Controller_Action
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
	  	$this->view->headTitle()->prepend('Relatórios');
	}

}