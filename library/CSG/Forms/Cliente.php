<?php
class CSG_Forms_Cliente extends Zend_Form
{

    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');
        $this->setAttrib('id', 'form_adicionar_cliente');
        
        $grupos = new Grupo();
    	$result = $grupos->getPairs();
    	
    	$form = new CSG_Evento_Object();
    	$locais = $form->getOpcaoLocal();
    	$categorias =  $form->getOpcaoCategoria();
        
        $nome = $this->createElement('text', 'nome', array('label' => 'Nome:', 'class' => 'nome'))
        			  ->setRequired(true);
        $this->addElement($nome);
  		
  		$email = $this->createElement('text', 'email', array('label' => 'E-mail:','class' => 'email'))
        			->setRequired(true);
        $this->addElement($email);
  		
  		$cel = $this->createElement('text', 'celular', array('label' => 'Celular:','class' => 'cel'))
        			->setRequired(true);
        $this->addElement($cel);
		
        $rg = $this->createElement('text', 'rg', array('label' => 'RG:','class' => ''))
        			->setRequired(true);
        $this->addElement($rg);
        
        $cpf = $this->createElement('text', 'cpf', array('label' => 'CPF:','class' => 'cpf'))
        			->setRequired(true);
        $this->addElement($cpf);
        
        $tipo = new Zend_Form_Element_Select('tipo');
		$tipo->setLabel('Tipo:')
				    ->addMultiOptions(array(
				    	'1' => $categorias[0],
				    	'2' => $categorias[1]
				    ));
		$this->addElement($tipo);
		
		$instituicao = $this->createElement('text', 'instituicao', array('label' => $locais[0].':','class' => 'instituicao'))
		->setRequired(false);
		$this->addElement($instituicao);
		
		$empresa = $this->createElement('text', 'empresa', array('label' => $locais[1].':','class' => 'empresa'))
        			->setRequired(false);
        $this->addElement($empresa);
		
		
        
        $grupo_id = $this->createElement('select', 'grupo_id', array('label' => 'Grupo:', 'class' => ''))
        			  ->setRequired(true)
        			  ->setMultiOptions($result)
        			  ->addValidator('NotEmpty', true);
        $this->addElement($grupo_id); 
		
		$tipo_participacao = new Zend_Form_Element_Select('tipo_participacao');
		$tipo_participacao->setLabel('Tipo de participação:')
				    ->addMultiOptions(array(
				    	'inscrito' => 'Inscrito',
				    	'apoio' => 'Apoio',
				    	'convite' => 'Convite',
				    	'imprensa' => 'Imprensa',
				    ));
		$this->addElement($tipo_participacao);
		
		$confirma_pagamento = new Zend_Form_Element_Select('confirma_pagamento');
		$confirma_pagamento->setLabel('Pagou:')
				    ->addMultiOptions(array(
				    	'0' => 'Não',
				    	'1' => 'Sim'
				    ));
		$this->addElement($confirma_pagamento);
		
		$endereco = $this->createElement('text', 'endereco', array('label' => 'Endereço:','class' => 'endereco'))
        			->setRequired(true);
        $this->addElement($endereco);
        
        $cep = $this->createElement('text', 'cep', array('label' => 'CEP:','class' => 'cep'))
        			->setRequired(false);
        $this->addElement($cep);
        
        $cidade = $this->createElement('text', 'cidade', array('label' => 'Cidade:','class' => 'cidade'))
        			->setRequired(false);
        $this->addElement($cidade);
        
        /*$estado = $this->createElement('text', 'estado', array('label' => 'Estado:','class' => 'estado'))
        			->setRequired(false);
        $this->addElement($estado);*/
        
        
        $estado = new Zend_Form_Element_Select('estado');
        $estado->setLabel('Estado:')
        ->addMultiOptions(array(
        		'ACRE' => 'ACRE',
        		'ALAGOAS' => 'ALAGOAS',
        		'AMAPÁ' => 'AMAPÁ',
        		'AMAZONAS' => 'AMAZONAS',
        		'BAHIA' => 'BAHIA',
        		'CEARÁ' => 'CEARÁ',
        		'DISTRITO FEDERAL' => 'DISTRITO FEDERAL',
        		'ESPIRITO SANTO' => 'ESPIRITO SANTO',
        		'GOIÁS' => 'GOIÁS',
        		'MARANHÃO' => 'MARANHÃO',
        		'MATO GROSSO DO SUL' => 'MATO GROSSO DO SUL',
        		'MATO GROSSO' => 'MATO GROSSO',
        		'MINAS GERAIS' => 'MINAS GERAIS',
        		'PARÁ' => 'PARÁ',
        		'PARAÍBA' => 'PARAÍBA',
        		'PARANÁ' => 'PARANÁ',
        		'PERNAMBUCO' => 'PERNAMBUCO',
        		'PIAUÍ' => 'PIAUÍ',
        		'RIO DE JANEIRO' => 'RIO DE JANEIRO',
        		'RIO GRANDE DO NORTE' => 'RIO GRANDE DO NORTE',
        		'RONDÔNIA' => 'RONDÔNIA',
        		'RORAIMA' => 'RORAIMA',
        		'SANTA CATARINA' => 'SANTA CATARINA',
        		'SÃO PAULO' => 'SÃO PAULO',
        		'SERGIPE' => 'SERGIPE',
        		'SÃO PAULO' => 'SÃO PAULO',
        		'TOCANTINS' => 'TOCANTINS'
        ));
        $this->addElement($estado);
        
        $pais = $this->createElement('text', 'pais', array('label' => 'País:','class' => 'pais'))
        			->setRequired(false);
        $this->addElement($pais);
        
                
        $twitter = $this->createElement('text', 'twitter', array('label' => 'Twitter:','class' => 'twitter'))
        			->setRequired(false);
        $this->addElement($twitter);
        
        $submit = $this->createElement('submit', 'outro', array('label' => 'Salvar e Adicionar outro', 'class' => 'button'));
        $this->addElement($submit);
        
        $submit = $this->createElement('submit', 'finalizar', array('label' => 'Salvar e Finalizar', 'class' => 'button'));
        $this->addElement($submit);
    }
}