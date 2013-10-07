<?php
class Admin_ClienteController extends Zend_Controller_Action
{

    public function init() {
    	if (!Zend_Auth::getInstance()->hasIdentity()) {
           // Se o usuário estiver logado, não queremos mostrar o formulário de login;
            if ('logout' != $this->getRequest()->getActionName()) {
                $this->_redirect("admin/auth");
            }
	  	}
    }
	
    public function indexAction()
    {   	
    	$cliente = new Cliente();		
		$this->view->clientes = $cliente->getTodosClientesAZ();
		
  		$this->view->headTitle()->prepend('Clientes');
    }
    
	public function adicionarAction()
    {
  		$form = new CSG_Forms_Cliente();
  		
  		if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
            	$data = $this->_request->getPost();
            	
            	if(isset($data['grupo_id'])){	            	
	            	$grupo = new Grupo;
					$grupo = $grupo->getAsArray($data['grupo_id']);
					$data['grupo_nome'] = $grupo['nome'];
            	}else{
            		$data['grupo_id'] = 0;
            		$data['grupo_nome'] = '';
            	}
				
            	if(isset($data['tipo'])){
	            	if($data['tipo']=='1'){
	            		$data['empresa'] = null;
	            	}elseif($data['tipo']=='2'){
	            		$data['instituicao'] = null;
	            	}
            	}
            	
            	//Zend_Debug::dump($data); ///die;
            	
            	$data['filiado'] = 0;
            	$cliente = new Cliente($data);
                $id = $cliente->save();
                
                if(!empty($data["finalizar"]) and $data["finalizar"]=='Salvar e Finalizar'){
                	$this->_redirect('/admin/cliente/ver/id/'.$id);
                }
            	$this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> Cliente adicionado com sucesso.");
            	
            }
        }
        
        $this->view->form = $form;
        $this->view->headTitle()->prepend('Adicionar cliente');
  		
    }
    
	public function editarAction()
    {
  		$cliente = new Cliente();
        $r_cliente = $cliente->getAsArray((int) $this->_getParam("id", 1));

        $form = new CSG_Forms_Cliente();
        $form->addElement(new Zend_Form_Element_Hidden("id", $r_cliente['id']));
        $form->addElement(new Zend_Form_Element_Hidden("data_confirma_pagamento", $r_cliente['data_confirma_pagamento']));
        $form->addElement(new Zend_Form_Element_Hidden("data_inscricao", $r_cliente['data_inscricao']));
        $form->populate($r_cliente);
        $form->removeElement('outro');
        $form->getElement('finalizar')->setLabel('Salvar');
        
        if ($this->getRequest()->isPost()) {
            if ($form->isValid($this->_request->getPost())) {
            	$data = $form->getValues();
            	
            	if($data['confirma_pagamento']=='0'){
            		$data['data_confirma_pagamento'] = null;
            	}elseif($data['confirma_pagamento']=='1'){
            		$data['data_confirma_pagamento'] = date("Y-m-d H:i:s");
            	}
            	
            	if($data['tipo']=='estudante'){
            		$data['empresa'] = null;
            	}elseif($data['tipo']=='profissional'){
            		$data['instituicao'] = null;
            	}
            	
            	$cliente = new Cliente($data);
                $cliente->save();
            	$this->_helper->messenger('success',"<img class='mid_align' alt='success' src='/img/icon_accept.png'> Cliente editado com sucesso.");
            }
        }

        $this->view->form = $form;
        $this->view->cliente = $r_cliente;
  		$this->view->headTitle()->prepend('Editar cliente');
    }
    
	public function deletarAction()
    {
  		$cliente = new Cliente();
  		$data = $cliente->getAsArray((int) $this->_getParam("id", 1));
  		$data['deletado'] = 1;
  		$data['data_deletado'] = date("Y-m-d H:i:s");
  		$data['usuario_id_deletado'] = Zend_Auth::getInstance()->getIdentity()->id;
  		
  		$r_cliente = new Cliente($data);
  		$r_cliente->save();
        $this->_helper->messenger('success',"Cliente deletado com sucesso.");
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_redirect('/admin/');
        
  		
    }
    
	public function verAction()
    {
  		$cliente = new Cliente();
        $r_cliente = $cliente->getAsArray((int) $this->_getParam("id", 1));
        $this->view->cliente = $r_cliente;
        
        /* Dados para gerar 2° via do boleto */
        $data['cliente'] = $r_cliente;
		$moip = $this->prepararMoip($data);
						
		$this->view->nome = $moip['nome'];
		$this->view->numeroCelular = $moip['numeroCelular'];
		$this->view->cpf = $moip['cpf'];
		$this->view->rg = $moip['rg'];
						
		$this->view->endereco = $moip['endereco'];
		$this->view->cep = $moip['cep'];
						
		$this->view->cidade = $moip['cidade'];
		$this->view->estado = $moip['estado'];
		/* Dados para gerar 2° via do boleto */
        
        $data_inscricao = new Zend_Date($r_cliente['data_inscricao']);
       	$this->view->data_inscricao = $data_inscricao->toString("dd/MM/yyyy H:mm:ss");

       	
       	if($r_cliente['confirma_pagamento']=='1'){
       		$transacao = new TransacaoMoip();
       		$transacao  = $transacao->getClientePagoPorEmail($r_cliente['email']);
       		
			//Se não for pago pelo sistema de pagamento       		
       		if(isset($transacao[0]->data_confirma_pagamento)){
       			$data_confirma_pagamento = new Zend_Date($transacao[0]->data_confirma_pagamento);
       		}else{
				//Apresenta a data_confirma_pagamento quando o usuário realizou a confirmação
				$data_confirma_pagamento = new Zend_Date($r_cliente['data_confirma_pagamento']);
			}
			
			$this->view->data_confirma_pagamento = '<span class="green">'.$data_confirma_pagamento->toString("dd/MM/yyyy H:mm:ss").'</span>';
			
       		if(isset($transacao[0]->tipo_pagamento)){
				$this->view->tipo_pagamento = $transacao[0]->tipo_pagamento;
			}else{
				$this->view->tipo_pagamento = '<span class="green">Confirmado pelo usuário do sistema.</span>';
			}
       	}else{
       		$this->view->data_confirma_pagamento = "<span class='red'>Ainda não realizou o pagamento</span>";
       	}
       
      
        $this->view->headTitle()->prepend('Visualizar cliente');
  		
    }
    
	
	public function buscarAction(){
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();
			$db = new DbTable_Cliente();
			
			if(isset($data['q'])){

				$valor = preg_split("/[,. ]/", $data['q']);
				$this->view->clientes = $db->getPesquisarTodos($valor);

			
			}else{		
				$this->view->clientes = $db->getPesquisar($data['nome'],$data['cpf'],$data['rg'],$data['email'],$data['twitter']);						
			}
			$this->view->data = $data;
		}
		$this->view->headTitle()->prepend('Buscar cliente');
	}
    
    public function ajaxAdicionarClienteAction(){
    	$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()) {
			$resposta = null;
			
			$data = $this->_getAllParams();	
				$grupo = new Grupo;
				$grupo = $grupo->getAsArray($data['grupo_id']);
				$data['grupo_nome'] = $grupo['nome'];
				
				$data['filiado'] = '';
				$data['hospedagem'] = '';
				$data['endereco'] = '';
				$data['cidade']   = '';
				$data['cpf']   = '';
				$data['rg']   = '';
				$data['estado']   = '';
				$data['pais']     = '';
				$data['cep']      = '';
				$data['tipo']     = '';

				$cliente = new Cliente($data);
				$id = $cliente->save();
				
				if(!empty($id)){
					$resposta['valor'] = '1';
				}else{
					$resposta['valor'] = '0';	
				}
			echo json_encode($resposta);	
		}
    }
    
    public function ajaxConfirmaPagamentoAction(){
    	$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
			
			$data = $this->_getAllParams();	
			
			if(!empty($data['id'])){
				$cliente = new Cliente();
				$cliente = $cliente->find($data['id']);
				
				//Zend_Debug::dump($cliente->getNome());die;
				
				$cliente->setConfirma_pagamento(1);
				$cliente->setData_confirma_pagamento(date("Y-m-d H:i:s"));
				
				$id = $cliente->save();
				
				if($id=='0'){
					//Confirmado com sucesso
					$resposta['valor'] = '1';
					
				}else{
					//Não foi possível confirmar
					$resposta['valor'] = '0';
				}
				
			}else{
				//Não recebi um valor de Id válido
				$resposta['valor'] = '2';
			}
			$resposta['nome'] = $cliente->getNome();
			echo json_encode($resposta);
		}
    }
    
    public function ajaxTotalClienteCategoriaEstadoAction(){
    	$this->_helper->viewRenderer->setNoRender();
    	if ($this->_getAllParams()){
    		$cliente = new Cliente();
    		$cat = $cliente->getTotalCatPorEstado();
    		
    		print json_encode($cat);
    	}
    }
    
	public function ajaxDatasRelatorioAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
			
			$data='';
			if(isset($data)){
				$data = $this->_getAllParams();	
			}
			
			$data['data'] = intval($data['data']);
			//Zend_Debug::dump($data['data']);die;
			
			$array = null;
			$aux = null;			
			for($i=0;$i<$data['data'];$i++){
				//Colocando as datas a serem pesquisadas em um array
				$array[$i] = date('Y-m-d',mktime(0, 0, 0, date("m"),date("d") - $i, date("Y")));
			}
				//Revertendo o array para que as ultimas datas sejam as primeiras
			$array = array_reverse($array);
			
			$cliente = new Cliente();
			$retorno = $cliente->getClientesInscritosNosXDIas($data['data']);
			$pagos = $cliente->getClientesPagosNosXDIas($data['data']);
			$total_pagos = $cliente->getTotalClientesPagos();
			$total_nao_pagos = $cliente->getTotalClientesNaoPagos();
			$total_inscritos = $cliente->getTotalClientesInscritos();
			$total_apoio = $cliente->getTotalApoio();
			$total_imprensa = $cliente->getTotalImprensa();
			$total_convite = $cliente->getTotalConvite();
			$aux2 = null;
			$i = 0;
			//Inscritos
			foreach($array as $a){
				
				$eIgual = false;
				//Variavel para verificar se a data do array é a mesma vinda do banco. Se for, ele insere no array aux2 os valores vindo do banco.
				
				foreach ($retorno as $val){		
					$x = new Zend_Date($val->data_inscricao);
					//print_r($x->toString('Y-MM-dd').'     '.$a.'<br>');
					
					if($x->toString('Y-MM-dd') == $a){
						$eIgual = true;
						$aux2['inscrito'][$i]['qtd_clientes_inscritos'] = doubleval($val->qtd_clientes_inscritos);					
						$aux2['inscrito'][$i]['data_inscricao'] = $x->toString('dd/MM');
					}
				}
				
				if($eIgual==false){
					$y = new Zend_Date($a);
					$aux2['inscrito'][$i]['qtd_clientes_inscritos'] = 0;					
					$aux2['inscrito'][$i]['data_inscricao'] = $y->toString('dd/MM');
					
				}
				$i++;
			}
			//Pagos
			$i = 0;
			foreach($array as $a){
				
				$eIgual = false;
				//Variavel para verificar se a data do array é a mesma vinda do banco. Se for, ele insere no array aux2 os valores vindo do banco.
				
				foreach ($pagos as $val){		
					$x = new Zend_Date($val->data_pagamento);
					//print_r($x->toString('Y-MM-dd').'     '.$a.'<br>');
					
					if($x->toString('Y-MM-dd') == $a){
						$eIgual = true;
						$aux2['pago'][$i]['qtd_clientes_pagos'] = doubleval($val->qtd_clientes_pagos);					
						$aux2['pago'][$i]['data_pagamento'] = $x->toString('dd/MM');
					}
				}
				
				if($eIgual==false){
					$y = new Zend_Date($a);
					$aux2['pago'][$i]['qtd_clientes_pagos'] = 0;					
					$aux2['pago'][$i]['data_pagamento'] = $y->toString('dd/MM');
					
				}
				$i++;
			}
			
			//Relatorio 2
			
			$aux2['inscritos'] = doubleval($total_inscritos->inscritos);
			$aux2['pagos'] = doubleval($total_pagos->pagos);
			$aux2['nao_pagos'] = doubleval($total_nao_pagos->nao_pagos);
			$aux2['apoio'] = doubleval($total_apoio->apoio);
			$aux2['imprensa'] = doubleval($total_imprensa->imprensa);
			$aux2['convite'] = doubleval($total_convite->convite);
			
			$aux2['nao_pagos'] = $aux2['nao_pagos'] - ($aux2['convite']+$aux2['apoio']+$aux2['imprensa']);
			
			//Zend_Debug::dump($aux2['nao_pagos']);die;
			
			print json_encode($aux2);
		}
	}
	
	public function exportPdfAction(){
		ini_set("memory_limit","192M");
		
		if($this->_getAllParams()){	
			$data=$this->_getAllParams();
		}

		include("../library/mpdf54/mpdf.php");
			
		// create object mpdf
		//...,top,x)
			
		$mpdf = new mPDF('win-2152','A4-L','','',20,15,35,25,10,10, 'L');
		$mpdf->allow_charset_conversion=true;
		$mpdf->SetFont('arial');
		$mpdf->SetTitle($md);
		$mpdf->SetAuthor('Candido');
		$mpdf->SetCreator('Candido');
		$mpdf->SetSubject('Candido');
			
		$htmlPdf = new CSG_Pdf_Cliente($data);
		
		//Zend_Debug::dump(file_get_contents('css/pdf.css'));die;
		// inclui css
		$css = file_get_contents('css/pdf.css');
		$mpdf->WriteHTML($css,1);

		$body = $htmlPdf->getHtml();
		$mpdf->WriteHTML($body,2);

		// Output pdf
				
		$evento = new CSG_Evento_Object();
		$nome = str_replace(' ', '_', $evento->getNomeEvento());
				
		$mpdf->Output('Lista_de_inscritos-'.$nome.'-'.date('d_m_y-H_i_s').'.pdf','D');
		$mpdf->debug = true;
		$mpdf->Output();

		//$this->_helper->layout->disableLayout();
		//$this->_helper->viewRenderer->setNoRender();

	}
	
	function prepararMoip($data){
			$retorno['numeroCelular']  = CSG_SMS_Send::somenteNumero($data['cliente']['celular']);
			$retorno['cep']  = CSG_SMS_Send::somenteNumero($data['cliente']['cep']);
			$retorno['cpf']  = CSG_SMS_Send::somenteNumero($data['cliente']['cpf']);
			$retorno['rg']  = CSG_SMS_Send::somenteNumero($data['cliente']['rg']);
						
			$retorno['nome'] = CSG_Evento_Validate::retirarAcentos($data['cliente']['nome']);
			$retorno['endereco'] = CSG_Evento_Validate::retirarAcentos($data['cliente']['endereco']);
			$retorno['estado'] = CSG_Evento_Validate::retirarAcentos($data['cliente']['estado']);
			$retorno['cidade'] = CSG_Evento_Validate::retirarAcentos($data['cliente']['cidade']);
			
			return $retorno;
	}

}