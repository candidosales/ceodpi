<?php
class CSG_Forms_AdminLogin extends Zend_Form{
	
	public function init(){
	
		$this->setMethod('post');
		$this->setAttrib('id', 'form_login');
		
		$email = $this->createElement('text', 'login', array('label'=>'Usuário: ','class'=>'long','title'=>'usuário','id'=>'usuario'))
					 ->setRequired(true);
		$this->addElement($email);
		
		$password = $this->createElement('password', 'senha', array('label'=>'Senha: ','class'=>'long','title'=>'senha'))
					 ->setRequired(true);
		$this->addElement($password);
					 
		$submit = $this->createElement('submit', 'submit',array('label'=>'Login','class'=>''));
		$this->addElement($submit);
		
	}

}