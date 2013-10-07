<?php
class Default_ClienteController extends Zend_Controller_Action
{
	private $twitter;

    public function init() {
		$twitterClient = new Twitter();
		$result = $twitterClient->authenticate();
		$this->twitter = $twitterClient->getTwitter();
    }
	
    public function indexAction()
    {

    } 
    
    public function twitterAction()
    {

		//$response = $this->twitter->directMessageNew('geovannia', 'teste');	

		//$response = $this->twitter->directMessageSent();
		$this->twitter->status->update('Teste');

		$this->view->statusMsgs = $response;
    } 
    
    public function ajaxAdicionarClienteAction(){
    	$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();
			
			
			$erros = $this->validaFormulario($data);
			
			if($erros['qtd']<1){			
				if($data['tipo'] == 'estudante'){
					$data['empresa'] = null;
				}elseif($data['tipo'] == 'profissional'){
					$data['instituicao'] = null;
				}
				
			    $data['grupo_id'] = 0;
				$data['grupo_nome'] = '';
				
				$data['twitter'] = str_replace('@','',$data['twitter']);

				$cliente = new Cliente($data);
				$resultado = $cliente->getClientePorCpf($data['cpf']);
				
				//Zend_Debug::dump($resultado);die;
				
				if(sizeof($resultado)<1 || empty($resultado)){
				
					$id = $cliente->save();
					
					if(!empty($id)){					
						
	      
						if(!empty($data['twitter'])){
						  $this->twitter->status->update('Obrigado @'.$data['twitter'].' por se inscrever em nosso curso. Por favor, siga @sinapropiaui para acompanhar nossas novidades. =]');
						  //$this->twitter->directMessageNew($data['twitter'], 'Obrigado @'.$data['twitter'].' por se inscrever em nosso curso. Por favor, siga @sinapropiaui para acompanhar nossas novidades. =]');
						  $resposta['twitter'] = 'true';
						}
						
						if(!empty($data['celular'])){
							
							$mensagem = 'obrigado por se inscrever! Estamos aguardando o pagamento de sua inscricao =].';
							$assinatura = 'SINAPRO Piaui';
							
							$cliente = new Cliente();
							$cliente = $cliente->getAsArray($id);
							
							$nome = explode(' ',$cliente['nome']);
							$mensagem = 'Sr. '.$nome[0].', '.$mensagem;
							
							$sms = new CSG_SMS_Send();
							$retorno = $sms->enviarIndividual($id,$data['celular'], $mensagem, $assinatura);
							
							if($retorno==000){
								$resposta['sms'] = 'true';
							}
						}
	
						$resposta['valor'] = '1';
					}else{
						$resposta['valor'] = '0';	
					}
				}else{
					$resposta['valor'] = '3';
				}
				echo json_encode($resposta);
			}else{
				$erros['valor'] = '2';	
				echo json_encode($erros);
			}
		}
    }
    
    public function validaFormulario($data){

			$erros = null;
			$erros['qtd'] = 0;
			if(empty($data['nome'])){
				$erros['valida'][$erros['qtd']] = 'Por favor, insira seu nome completo';
				$erros['qtd']++;
			}
			if(empty($data['cpf'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu cpf';
					$erros['qtd']++;
				}
			if(empty($data['rg'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu rg';
					$erros['qtd']++;
				}
			if(empty($data['endereco'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu endereco';
					$erros['qtd']++;
				}
			if($data['tipo'] == 'estudante' && empty($data['instituicao'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, se você é estudante, insira sua instituição';
					$erros['qtd']++;
			}
   			if($data['tipo'] == 'profissional' && empty($data['empresa'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, se você é profissional, insira onde trabalha';
					$erros['qtd']++;
			}
			if($data['celular'] == ''){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu celular';
					$erros['qtd']++;
				}
			
			return $erros;
    }

}