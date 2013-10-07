<?php
class Admin_AuthController extends Zend_Controller_Action{
	
	public function indexAction()
	{
		$form = new CSG_Forms_AdminLogin();
		
		if (Zend_Auth::getInstance()->hasIdentity()) {
           // Se o usuário estiver logado no módulo admin, não queremos mostrar o formulário de login;
           $regra = Zend_Auth::getInstance()->getIdentity()->regra;
            if ('logout' != $this->getRequest()->getActionName() and ($regra =="usuario")) {
                $this->_redirect("default/index");
            }else{
            	$this->_redirect("admin/index");
            }
	  	}
		
		$this->view->form = $form;
		
		if($this->_request->isPost()){
			$data = $this->_request->getPost();
			if($form->isValid($data)){				
				$authAdapter = $this->getAuthAdapter();
				$authAdapter->setIdentity($data['login'])
							->setCredential($data['senha']);
							
				$result = $authAdapter->authenticate();
				
				if($result->isValid()){
					$auth = Zend_Auth::getInstance();
					$auth->setStorage(new Zend_Auth_Storage_Session('admin'));
					$dataAuth = $authAdapter->getResultRowObject(null,'senha');
					$auth->getStorage()->write($dataAuth);

					$this->_redirect("admin/");
				} else {
                    $this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Usuário ou senha inválidos.");
                }
			}
		}
		
		$this->_helper->layout->disableLayout();
	}
	
	//para Usuário
	public function getAuthAdapter(){
		$bootstrap = $this->getInvokeArg('bootstrap');
		$resource = $bootstrap->getPluginResource('db');
		$db = $resource->getDbAdapter();
		$authAdapter = new Zend_Auth_Adapter_DbTable($db);
		$authAdapter->setTableName('usuario')->setIdentityColumn('login')
					->setCredentialColumn('senha')
					->setCredentialTreatment('regra<>"" and regra <> "usuario"');
		return $authAdapter;
	}
	
 	public function logoutAction() {
 		
        $auth = Zend_Auth::getInstance ();
        $regra = $auth->getIdentity()->regra;
        
        //Atualizar o ultimo_acesso no banco
       //	$this->ultimoAcesso($auth->getIdentity()->id);
        
        $auth->setStorage(new Zend_Auth_Storage_Session('admin'));
        $auth->clearIdentity();
        $this->_redirect("admin/auth");
    }
    
    public function acessoNegadoAction() {
		$this->_helper->messenger('warning',"<img class='mid_align' alt='warning' src='/img/icon_warning.png'> Você precisa ter uma permissão para acessá-la.");
    }
    
    public function ultimoAcesso($id){
    		$usuario = new Usuario();
			$res_usuario = $usuario->getAsArray($id);
			$res_usuario['ultimo_acesso'] = date("Y-m-d H:i:s");
			$usuario2 = new Usuario($res_usuario);
			$usuario2->save();
    }
    
	public function esqueciSenhaAction() {
   		 $form = new ADV_Forms_EsqueciSenha();
   		 $this->view->formEsqueci = $form;
		 $this->_helper->layout->disableLayout();
		 
		 if($this->_request->isPost()){
			$data = $this->_request->getPost();
			if($form->isValid($data)){	}
		 		$funcionario = new Funcionario;
		 		$rfuncionario = $funcionario->getDadosPorEmailFuncionario($data['email']);
		 		if($rfuncionario!=null){
						//$conta = "candidosg@gmail.com";//Aqui vc coloca a conta do GMAIL
						//$senha = "*******";//Aqui vc coloca o seu email do GMAIL.
						$de = "contato@hmaciel.com.br";//Aqui vc coloca o email de quem está enviando o email.
						$para = "".$data['email']."";//Aqui vc coloca para quem vai o email.
						$assunto = "HMaciel - Senha recuperada";
						$mensagem = "Estimado,<br><br><b>Seu login:</b> ".$rfuncionario['login']." <br><br><b>Sua senha:</b> ".$rfuncionario['senha']."<br><br> Atenciosamente,<br><i>HMaciel</i>";
						
						try {
							//$mailTransport = new ADV_Service_Notifier_EsqueciSenha();
							$mail = new Zend_Mail();
							$mail->setFrom($de);
							$mail->addTo($para);
							$mail->setBodyHtml($mensagem);
							$mail->setSubject($assunto);
							//$mail->send($mailTransport);
							$mail->send();

							$this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> E-mail enviado! Verifique sua caixa de ENTRADA ou SPAM no seu e-mail.");
						} catch (Exception $e){
							echo ($e->getMessage());
						}
								 			
		 		}else{
		 			$this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Desculpe, este e-mail não está cadastrado.");
		 		}
		 }
    }
}