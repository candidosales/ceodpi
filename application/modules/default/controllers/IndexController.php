<?php
class Default_IndexController extends Zend_Controller_Action
{
	private $evento;
 	public function init()
    {
        $this->evento = new CSG_Evento_Object();
    }

    public function indexAction()
    {
    	  $this->_helper->layout()->disableLayout();
    }
	
	public function inscricaoAction(){
	
    	$this->view->headTitle()->prepend('Inscrição');
    	$this->view->pagseguroCategorias = $this->evento->getOpcaoCategoria();
    	$this->view->pagseguroValores = $this->evento->getOpcaoValor();
    	
    	$total_inscritos = new Cliente();
    	$this->view->total = $total_inscritos->getTotalClientesInscritos();
    }
	
	public function inscritoAction(){
	
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();
			
			$data['cliente'] = true;
			
			$jaCadastrado = $this->verificaInscricao($data);

			if($jaCadastrado){
				$this->_helper->messenger('warning','<img class="mid_align" alt="warning" src="/img/icon_warning.png"> Você já está inscrito neste evento. Envie e-mail para <a href="mailto:'.$this->evento->getContatoEmail().'">'.$this->evento->getContatoEmail().'</a> para qualquer dúvida ou para gerar 2° via do boleto.');	
				$this->_redirect('/inscricao');
			}else{
				$erros = CSG_Evento_Validate::validarFormulario($data);

				if($erros['qtd']<1){
					
					$evento = new CSG_Evento_Object();
					
					$data['grupo_id'] = 1;
					$data['grupo_nome'] = $this->evento->getNomeEvento();
					$data = $this->tratamento($data);
					$cliente = new Cliente($data);
					$id = $cliente->save();
					
					if(!empty($id)){					
						if(!empty($data['twitter'])){
							CSG_Evento_Service::enviarTwitter($data);
						}
						
						if(!empty($data['celular'])){
							$data['id'] = $id;
							$data['cliente'] = $cliente;
							CSG_Evento_Service::enviarSms($data);
						}
						
						if(!empty($data['email'])){
							$data['tipo_mensagem'] = 'inscricao';
							CSG_Evento_Service::enviarEmail($data);
						}
						//Zend_Debug::dump($data);die;
						$valor_inscricao = $this->calcularValorInscricao($data);
						$this->view->forma_pagamento = 'gratuito';
						if($valor_inscricao != '0.00'){
											
							//Formas de Pagamento: PagSeguro ou MoIP
							if($this->evento->getFormaPagamento()=='pagseguro'){
									
								$paymentRequest = new PagSeguroPaymentRequest();
								$paymentRequest->setCurrency("BRL");
								$paymentRequest->setSender(
										Array(
												'name' => $data['nome'],
												'email' => $data['email'],
												'areaCode' => $data['ddd'],
												'number' => $data['celular-ddd']
										)
								);
								
								$paymentRequest->addItem(
										Array(
												'id' => '0001',
												'description' => 'Inscrição para '.$data['tipo'].' do '.$evento->getNomeEvento(),
												'quantity' => 1,
												'amount' => $valor_inscricao,
												'weight' => 0,
										)
								);
								
								$transacao = new TransacaoPagseguro();
								$transacao->setCliente_id($id);
								$transacao->setCliente_nome($cliente->getNome());
								$transacao->setValor($valor_inscricao);
								
								/* Código de referência gerado pelo seu sistema */
								$idTransacao = $transacao->save();
		
								/* Informando o código de referência no objeto PagSeguroPaymentRequest */
								$paymentRequest->setReference($idTransacao);
								
								/* Quando finalizar o pagamento ser redirecionado para uma página de sucesso */
								$paymentRequest->setRedirectURL("http://encontro.sinapropiaui.com.br/obrigado");
								$paymentRequest->setMaxAge(172800); //2 dias
								
								/* Obtendo credenciais definidas no arquivo de configuração */
						    	$credentials = PagSeguroConfig::getAccountCredentials();
						    	try {
						    		/* Utilizando credenciais definidas no arquivo de configuração */
						    		$url = $paymentRequest->register($credentials);
						    		$posicao = strpos($url, '=');
						    		$code = substr($url, $posicao+1);
						    	
						    	} catch (PagSeguroServiceException $e) {
						    			
						    		echo $e->getHttpStatus(); // imprime o código HTTP
						    	
						    		foreach ($e->getErrors() as $key => $error) {
						    			echo $error->getCode(); // imprime o código do erro
						    			echo $error->getMessage(); // imprime a mensagem do erro
						    		}
						    	
						    	}
						    	
						    	
								$this->view->codePagSeguro = $code;
						    	$this->view->urlPagSeguro = $url;
						    	$this->view->forma_pagamento = 'pagseguro';
						    	$this->view->valor_apresentacao = $valor_inscricao;
							}
							
							if($this->evento->getFormaPagamento()=='moip'){
								/*
								 * MoIP
								 */
								$transacao = new TransacaoMoip();
								$transacao->setCliente_id($id);
								$transacao->setCliente_nome($cliente->getNome());
								$transacao->setValor($valor_inscricao);
								
								$idTransacao = $transacao->save();
								
								$data['cliente'] = $cliente;
								$moip = $this->prepararMoip($data);
								
								$this->view->nome = $moip['nome'];
								$this->view->numeroCelular = $moip['numeroCelular'];
								$this->view->cpf = $moip['cpf'];
								$this->view->rg = $moip['rg'];
								
								$this->view->endereco = $moip['endereco'];
								$this->view->cep = $moip['cep'];
								
								$this->view->cidade = $moip['cidade'];
								$this->view->estado = $moip['estado'];
								$this->view->idTransacao = $idTransacao;
								$this->view->valor_inscricao = $valor_inscricao;
								$this->view->valor_apresentacao = CSG_Evento_Validate::formatoDinheiroMoip($valor_inscricao);
							
								$this->view->forma_pagamento = 'moip';
							}
						}
						$this->view->cliente = $cliente;
						$this->_helper->messenger('success','<img class="mid_align" alt="success" src="/img/icon_accept.png"> Sr(a) '.$data['nome'].', sua inscrição foi realizada com sucesso!');	
						$this->view->emailContato = $this->evento->getContatoEmail();
					}
				}else{
					$html ='';
					
					foreach ($erros['valida'] as $erro)
						$html.='<li>'.$erro.'</li>';
					
					$this->_helper->messenger('error',$html);	
					$this->_redirect('/inscricao');
				}
			}
		}
		

		$this->view->headTitle()->prepend('Inscrito');
		
	}
	
	public function pagamentoAction(){
		
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();
		}
		
		$this->view->headTitle()->prepend('Pagamento');
	}
	
	public function certificadoAction(){
		$cliente = new Cliente();
		$this->view->clientes = $cliente->getTodosClientesPagosAZ();
		$this->view->headTitle()->prepend('Certificado');
	}
    
    public function palestrantesAction(){$this->view->headTitle()->prepend('Palestrantes');   }
	
	public function programacaoAction(){$this->view->headTitle()->prepend('Programação'); }
	
	public function teresinaAction(){$this->view->headTitle()->prepend('Teresina');}
	
	public function hospedagemAction(){$this->view->headTitle()->prepend('Hospedagem'); }
	
	public function noticiasAction(){$this->view->headTitle()->prepend('Notícias'); }
	
	public function premioDestaquePropagandaAction(){	
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();
			
			//Zend_Debug::dump($data);die;
			
			$data['participante'] = true;
			if(isset($data['nome'])){
				$jaCadastrado = $this->verificaInscricao($data);
				
				//Zend_Debug::dump($jaCadastrado);//die;
				
				if($jaCadastrado){
					$this->_helper->messenger('warning',"<img class='mid_align' alt='warning' src='/img/icon_warning.png'> Você já participou com sua opinião. Obrigado.");
					$this->_redirect('/premio-destaque-propaganda');
				}else{
					$erros = CSG_Premiacao_Validate::validarFormulario($data);
				
					if($erros['qtd']<1){
				
						$participante = new Participante($data);
						$id  = $participante->save();
						if(!empty($id)){
						
							$this->_helper->messenger('success','<img class="mid_align" alt="success" src="/img/icon_accept.png"> Sr(a) '.$data['nome'].', Obrigado por participar e contribuir com nossa indústria da comunicação reconhecendo os destaques deste ano.');
							$this->view->bloqueiaForm = true;
						}
					}else{			
						$html ='';
							
						foreach ($erros['valida'] as $erro)
							$html.='<li>'.$erro.'</li>';
							
						$this->_helper->messenger('error',$html);
						$this->_redirect('/premio-destaque-propaganda');
					}
				}
			}
		}
		$this->view->bloqueiaForm = false;
		$this->view->headTitle()->prepend('Prêmio Destaque da Propaganda Piauiense 2012');
	}
	
	public function obrigadoAction(){
		$this->view->headTitle()->prepend('Obrigado');
	}
	
	public function contatoAction(){
		$this->view->headTitle()->prepend('Contato');
		$this->view->emailContato = $this->evento->getContatoEmail();
		$this->view->twitter = $this->evento->getUrlTwitter();
		$this->view->facebook = $this->evento->getUrlFacebook();
	}
    
    public function finalizadoPagamentoAction(){$this->view->headTitle()->prepend('Finalizado Pagamento'); }
        
    public function notificacaoMoipAction(){
    	
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	
    	if ($this->_getAllParams()) {
    		$data = $this->_getAllParams();
    		
    		if(isset($data['status_pagamento'])){
    			
	    		/*$data['id_transacao']; $data['valor']; $data['status_pagamento']; $data['cod_moip'];
				$data['forma_pagamento']; $data['tipo_pagamento']; $data['email_consumidor'];*/
				
				$transacao = new TransacaoMoip($data);
				$transacao->save();
				
				if($data['status_pagamento']==6 || $data['status_pagamento']==4 || $data['status_pagamento']==1 ){
				
					$cliente = new Cliente();
					$cliente_result = $cliente->getClientePorEmail($data['email_consumidor']);
					
					$cliente_result[0]->confirma_pagamento = 1;
					$cliente_result[0]->data_confirma_pagamento = date("Y-m-d H:i:s");
									
					$cliente = new Cliente((array) $cliente_result[0]);
					$cliente->save();
					
					//Já realizaram o pagamento, entretanto está em análise ou ainda não foi creditado
					if($data['status_pagamento']==1 || $data['status_pagamento']==6){				
						/*
						 * Enviar e-mail agradecendo o pagamento da inscrição
						 */
						$data['tipo_mensagem'] = 'pagamento';
						$data['email'] = $data['email_consumidor'];
						$data['nome'] = $cliente_result[0]->nome;
						
						CSG_Evento_Service::enviarEmail($data);
					}
					
					/*
					 * Enviar relatório dos últimos pagos por e-mail
					 */
					$transacao = new TransacaoMoip();
					$clientes = $transacao->getClientesPeloMoip();
				
					$clientes['tipo_mensagem'] = 'relatorio';
					$clientes['email'] = 'candidosg@gmail.com';
					
					CSG_Evento_Service::enviarEmail($clientes);
				}
    		}else{
    			echo 'Desculpa. Sem informacoes sobre notificacao do moip';
    		}
    	}
    }
    
    public function notificacaoPagseguroAction(){
    	 
    	$this->_helper->layout()->disableLayout();
    	$this->_helper->viewRenderer->setNoRender();
    	 
    	if ($this->_getAllParams()) {
    		$data = $this->_getAllParams();
    
    		if(isset($data['notificationType'])){
    			
    			//$notificationType  que representa o tipo de notificação 
    			//$notificationCode  que representa o código de notificação.

    			$credentials = PagSeguroConfig::getAccountCredentials();
    			
    			if ($data['notificationType'] === 'transaction') {
    			
    				/* Obtendo o objeto PagSeguroTransaction a partir do código de notificação */
    				$transaction = PagSeguroNotificationService::checkTransaction(
    						$credentials,
    						$data['notificationCode'] // código de notificação
    				);
    				
    				$status = $transaction->getStatus();
    				$sender = $transaction->getSender();
    				
    				if($status->getValue() == 2 || $status->getValue() == 3 || $status->getValue() == 4){
    					$cliente = new Cliente();
    					$cliente_result = $cliente->getClientePorEmail($sender->getEmail()); 

    					$cliente_result[0]->confirma_pagamento = 1;
    					$cliente_result[0]->data_confirma_pagamento = date("Y-m-d H:i:s");
    					
    					$cliente = new Cliente((array) $cliente_result[0]);
    					$cliente->save();
    					
    					if($data['status']==2 || $data['status']==3){
    						/*
    						 * Enviar e-mail agradecendo o pagamento da inscrição
    						*/
    						$data['tipo_mensagem'] = 'pagamento';
    						$data['email'] = $sender->getEmail();
    						$data['nome'] = $cliente_result[0]->nome;
    					
    						CSG_Evento_Service::enviarEmail($data);
    					}
    						
    						$transacao = new TransacaoPagseguro();
    						$clientes = $transacao->getClientesPeloPagseguro();
    						
    						$clientes['tipo_mensagem'] = 'relatorio';
    						$clientes['email'] = 'candidosg@gmail.com';
    							
    						CSG_Evento_Service::enviarEmail($clientes);
    				}
    			
    			}
    			
    		}else{
    			echo 'Desculpa. Sem informacoes sobre notificacao do pagseguro';
    		}
    		
    	}
    }
    
    /* Função que trata todos os requisitos para adicionar um inscrito */
	function tratamento($data){
	
				if($data['tipo'] == '1'){
					$data['empresa'] = null;
					$data['filiado'] = 0;
					$data['tipo_filiado'] = null;
				}elseif($data['tipo'] == '2'){
					$data['instituicao'] = null;
					if(!isset($data['filiado'])){
						$data['tipo_filiado'] = null;
						$data['filiado'] = 0;
					}
				}

				$data['ddd'] = substr($data['celular'], 1, 2);
				$data['celular-ddd'] = str_replace(array('-', ' '), null, substr($data['celular'], 4));

				$data['twitter'] = str_replace('@','',$data['twitter']);
					
			return $data;
	}
	
	/* Verifica se já está inscrito */
	function verificaInscricao($data){
		
		if(isset($data['cliente']) && $data['cliente']==true){
			$cliente = new Cliente($data);
			$result = $cliente->getClientePorCpf($data['cpf']);
			
			if (count($result) > 0) 
				return true;
		}
		
		if(isset($data['participante']) && $data['participante']==true){
			$participante = new Participante($data);
			$result = $participante->getParticipantePorCpf($data['cpf']);
				
			if (count($result) > 0)
				return true;
		}
		return false;
	}
	
	function prepararMoip($data){
			$retorno['numeroCelular']  = CSG_SMS_Send::somenteNumero($data['celular']);
			$retorno['cep']  = CSG_SMS_Send::somenteNumero($data['cep']);
			$retorno['cpf']  = CSG_SMS_Send::somenteNumero($data['cpf']);
			$retorno['rg']  = CSG_SMS_Send::somenteNumero($data['rg']);
						
			$retorno['nome'] = CSG_Evento_Validate::retirarAcentos($data['cliente']->getNome());
			$retorno['endereco'] = CSG_Evento_Validate::retirarAcentos($data['cliente']->getEndereco());
			$retorno['estado'] = CSG_Evento_Validate::retirarAcentos($data['cliente']->getEstado());
			$retorno['cidade'] = CSG_Evento_Validate::retirarAcentos($data['cliente']->getCidade());
			
			return $retorno;
	}
	
	function calcularValorInscricao($data=null){
	
		if($this->evento->getFormaPagamento()=='pagseguro'){
			//PagSeguro
			$categorias = $this->evento->getOpcaoCategoria();
			$valores = $this->evento->getOpcaoValor();
			
			if($data['tipo'] =='estudante'){
				return $valores[1];
			}
			
			if($data['tipo'] == 'profissional'){
				if($data['filiado']){
					/*if($data['tipo_filiado']=='diretor'){
						return $valores[0];
					}
					if($data['tipo_filiado']=='funcionario'){
						return $valores[1];
					}*/
					return $valores[0];
				}
				return $valores[2];
			}
		}
	
	if($this->evento->getFormaPagamento()=='moip'){
		
			if($data['tipo']=='2'){
				return '5000';
			}
		
		
	      //MoIP
		  $evento = new CSG_Evento_Object();
    	  $prazos = $evento->getPrazosDiasAntes();
    	  $valores = $evento->getValores();
    	  $valor_inicial = $evento->getValorInicial();
    	  $vagas = $evento->getQuantidadeVagas();
    	  
    	  $hoje = new Zend_Date();
    	  $hoje = $hoje->toString('dd/MM/YYYY');
    	  
    	  $dataInicio = new Zend_date($hoje, 'dd/MM/YYYY');
          $dataFim = new Zend_date($evento->getDataEncerraInscricao(),'dd/MM/YYYY' );

          $diferenca = floor( ( $dataFim->getTimestamp() - $dataInicio->getTimestamp() ) / ( 3600 * 24 ) );  
     
	        $valor_boleto = $valor_inicial;
	        
	        $qtd = count($prazos);
	        for($i=0;$i< $qtd;$i++){
		        if($diferenca <= $prazos[$i]){
		        	$valor_boleto = $valores[$i];
		        }
	        }
	        
	       return $valor_boleto;
		}
	}
	

    
}