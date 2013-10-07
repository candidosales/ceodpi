<?php
class CSG_Forms_Usuario extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        
        $nome = $this->createElement('text', 'nome', array('label' => 'Nome:', 'class' => 'nome'))
        			  ->setRequired(true);
        $this->addElement($nome);
         
        $login = $this->createElement('text', 'login', array('label' => 'Login:','class' => 'login'))
        			  ->setRequired(true)
        			  ->addFilter('StringtoLower')
        			  ->addValidator('regex', false, array('/^[a-z]/i'));
        $this->addElement($login);
        
        $senha = $this->createElement('password', 'senha', array('label' => 'Senha:','class' => 'senha'))
        			->setRequired(false);
        $this->addElement($senha);
        
        $regra = new Zend_Form_Element_Select('regra');
		$regra->setLabel('Função:')
				    ->addMultiOptions(array(
						'visitante' => 'Visitante',
				    	'assistente' => 'Assistente',
				    	'administrador' => 'Administrador'
				    ));
		$this->addElement($regra);
        
		$email = $this->createElement('text', 'email', array('label' => 'E-mail:','class' => 'email'))
        			->setRequired(true)->addValidator('EmailAddress');
        $this->addElement($email);
        
        $telefone = $this->createElement('text', 'tel', array('label' => 'Telefone:', 'class' => 'tel'))
        			  ->setRequired(true);
        $this->addElement($telefone);
		
        $submit = $this->createElement('submit', 'outro', array('label' => 'Salvar e Adicionar outro', 'class' => 'button'));
        $this->addElement($submit);
        
        $submit = $this->createElement('submit', 'finalizar', array('label' => 'Salvar e Finalizar', 'class' => 'button'));
        $this->addElement($submit);
    }
}