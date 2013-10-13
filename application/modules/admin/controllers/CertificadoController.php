<?php
class Admin_CertificadoController extends Zend_Controller_Action
{
	public function init()
	{
		if (!Zend_Auth::getInstance()->hasIdentity()) {
			// Se o usuário estiver logado, não queremos mostrar o formulário de login;
			$data=$this->_getAllParams();
	
			//Isso permite que o visitante não estando logado consiga o seu certificado
			if($data['module'] !='admin' && $data['action'] !='export'){
				if ('logout' != $this->getRequest()->getActionName()) {
					$this->_redirect("admin/auth");
				}
			}
		}
	}

	public function indexAction() {

		$cliente = new Cliente();
		$this->view->clientes = $cliente->getTodosClientesPagosAZ();
		$this->view->headTitle()->prepend('Painel do Administrador');
	}
	
	public function exportAction(){		
		if($this->_getAllParams()){	
			$data=$this->_getAllParams();
		}
		//Zend_Debug::dump($data);die;
		$cliente = new Cliente();
		$cliente = $cliente->getClientePorId($data['id']);

		//Zend_Debug::dump($cliente);die;
		if(!empty($cliente)){	
			if($cliente->confirma_pagamento!=0){
				$certificado = new CSG_Pdf_GerarCertificado($cliente);
			}else{
				$this->_helper->messenger('warning',"<img class='mid_align' alt='warning' src='/img/icon_warning.png'> Desculpa, mas você não confirmou sua inscrição.");
				$this->_redirect('/admin/cliente/ver/id/'.$cliente['id'].'');
			}
		
		}else{
			$this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Desculpa, este usuário não existe.");
			$this->_redirect('/admin');
		}

		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();

	}

}