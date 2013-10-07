<?php
class Admin_UsuarioController extends Zend_Controller_Action
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

    public function indexAction()
    {
  		$grid = new CSG_Grids_Usuario();
		if($grid->getGrid()!=null){
  			$this->view->grid = $grid->getGrid()->deploy();
    	}else{
  			$this->_helper->messenger('info',"<img class='mid_align' alt='info' src='/img/icon_info.png'> Nenhum usuário inserido.");
  		}
  		$this->view->headTitle()->prepend('Usuários');
    }
    
	public function adicionarAction()
    {
  		$form = new CSG_Forms_Usuario();
  		
  		if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
            	$data = $this->_request->getPost();
            	$usuario = new Usuario;
            	$r_usuario = $usuario->getVerificaLogin($data['login']);
            	
            	if($r_usuario==1){
            		$this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Login já cadastrado, por favor insira outro.");
            	}else{
	            	$usuario = new Usuario($form->getValues());
	                $id = $usuario->save();
	                if(!empty($data["finalizar"]) and $data["finalizar"]=='Salvar e Finalizar'){
	                	$this->_redirect('/admin/usuario/ver/id/'.$id);
	                }
	            	$this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> Usuário adicionado com sucesso.");
            	}
            }
        }

        $this->view->form = $form;
        $this->view->headTitle()->prepend('Adicionar cliente');
  		
    }
    
	public function editarAction()
    {
  		$usuario = new Usuario();
        $r_usuario = $usuario->getAsArray((int) $this->_getParam("id", 1));

        $form = new CSG_Forms_Usuario();
        $form->addElement(new Zend_Form_Element_Hidden("id", $r_usuario['id']));
        $form->removeElement('outro');
        $form->getElement('finalizar')->setLabel('Salvar');
        $form->populate($r_usuario);
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
            	$data = $this->_request->getPost();
            	$usuario = new Usuario;
            	$r_usuario = $usuario->getVerificaLogin($data['login'],$data['id']);
            	
            	if($r_usuario==3){
            		$this->_helper->messenger('error',"<img class='mid_align' alt='error' src='/img/icon_error.png'> Login já cadastrado, por favor insira outro.");
            	}elseif($r_usuario==2){
            		$data['deletado'] = 0;
            		$usuario = new Usuario($data);
            		$usuario->setDeletado('0');
                	$usuario->save();
            		$this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> Usuário editado com sucesso.");
            	}
            }
        }
        
        $this->view->form = $form;
  		$this->view->headTitle()->prepend('Editar usuário');
    }
    
	public function deletarAction()
    {
  		$usuario = new Usuario();
  		$data = $usuario->getAsArray((int) $this->_getParam("id", 1));
  		$data['deletado'] = 1;
  		$data['data_deletado'] = date("Y-m-d H:i:s");
  		$data['usuario_id_deletado'] = Zend_Auth::getInstance()->getIdentity()->id;
  		
  		$r_usuario = new Usuario($data);
  		$r_usuario->save();
  		
  		//se ele for o mesmo usuário logado, o mesmo será deslogado e redirecionado
  		//para página de login
  		if((Zend_Auth::getInstance()->getIdentity()->id == $this->_getParam("id", 1))){
      		$this->_redirect('/admin/auth/logout/');
  		}
        $this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> Usuário deletado com sucesso.");
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_redirect('/admin/usuario/');
        
  		
    }
    
	public function verAction()
    {
    	
  		$usuario = new Usuario();
        $r_usuario = $usuario->getAsArray((int) $this->_getParam("id", 1));
        
        if((Zend_Auth::getInstance()->getIdentity()->id == $this->_getParam("id", 1)) || (Zend_Auth::getInstance()->getIdentity()->regra == 'administrador')){
       		$this->view->usuario = $r_usuario;
        	$this->view->headTitle()->prepend('Visualizar usuário');
        }else{
        	$this->_redirect('/admin/auth/acesso-negado');
        }
    }
}