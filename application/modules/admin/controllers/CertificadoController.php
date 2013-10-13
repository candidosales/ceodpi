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
		ini_set("memory_limit","192M");
		
		if($this->_getAllParams()){	
			$data=$this->_getAllParams();
		}
		
		//Zend_Debug::dump($data);die;
		
		$cliente = new Cliente();
		$cliente = $cliente->getAsArray($data['id']);

		
		if(is_array($cliente)){	
			if($cliente['confirma_pagamento']!=0){
		
				include("../library/MPDF57/mpdf.php");
					
				// create object mpdf
				//...,top,x)
				
				$evento = new CSG_Evento_Object();
					
				$mpdf = new mPDF('win-2152','A4-L','','',20,15,35,25,10,10, 'L');
				$mpdf->allow_charset_conversion=true;
				$mpdf->SetTitle($evento->getNomeEvento().' - Certificado - '.$cliente['nome']);
				$mpdf->SetAuthor($evento->getNomeEvento());
				$mpdf->SetCreator($evento->getNomeEvento());
				$mpdf->SetSubject($evento->getNomeEvento().' - Certificado - '.$cliente['nome']);
		
			
				$htmlPdf = new CSG_Pdf_Certificado($cliente['nome']);
				
				//Zend_Debug::dump(file_get_contents('css/pdf.css'));die;
				// inclui css

				$css = file_get_contents('css/certificado.css');
				$mpdf->WriteHTML($css,1);
				$body = $htmlPdf->getHtml();
				
				//print_r($body);die;
		
				$mpdf->WriteHTML($body,2);
		
				// Output pdf
				$nome = str_replace(' ', '_', $cliente['nome']);
						
				$mpdf->Output('Certificado-'.$nome.'-'.date('d_m_y-H_i_s').'.pdf','D');
				$mpdf->debug = true;
				$mpdf->Output();
			}else{
				$this->_helper->messenger('warning',"<img class='mid_align' alt='warning' src='/img/icon_warning.png'> Desculpa, mas você não confirmou sua inscrição.");
				$this->_redirect('/admin/cliente/ver/id/'.$cliente['id'].'');
			}
		
		}else{
			$this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Desculpa, este usuário não existe.");
			
			if($data['_module']!='admin'){			
				$this->_redirect('/certificado');
			}
			$this->_redirect('/admin');
		}

		$this->_helper->layout->disableLayout();
		$this->_helper->viewRenderer->setNoRender();

	}

}