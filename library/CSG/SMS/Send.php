<?php
class CSG_SMS_Send 
{
	private $account = 'vendepubli';
	private $code = 'vxzc3eYfTr';
	
	public static function somenteNumero($valor){
		$valor = str_replace(array('(',')','-',' ','.'), '', $valor);       	
		return $valor;
	}
	
	public function testeSms($celular){
		$mobile = "55".$celular;
		$msg = "Teste de Mensagem";
		$msg = URLEncode($msg);
		$response = fopen("http://system.human.com.br/GatewayIntegration/msgSms.do?dispatch=send&account=vendepubli&code=vxzc3eYfTr&to=".$mobile."&msg=".$msg,"r");
		$status_code = fgets($response,4);
		
		return $status_code;
	}
	
	public function getStatusCode($status_code){
		switch($status_code){
				//enviado!
				case 000:
			        return '<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Mensagem enviada com sucesso</p></div>';
			        break;
			    //problemas.
			    	//Criei
				case 002:
					return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="delete" class="mid_align"/>Você selecionou nenhum cliente. Por favor, selecione algum antes de enviar a mensagem.</p></div>';
					break;
			    case 010:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Mensagem vazia</p></div>';
			        break;
			    case 011:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Corpo da mensagem inválido</p></div>';
			        break;
			    case 012:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Corpo da mensagem excedeu o limite. Os campos "from" e "body" devem ter juntos no máximo 150 caracteres.</p></div>';
			        break;
			    case 013:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Número do destinatário está incompleto ou inválido.</p></div>';
			        break;
			    case 014:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Número do destinatário está vazio.</p></div>';
			        break;
			    case 015:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>A data de agendamento está mal formatada. O formato correto deve ser: "dd/MM/aaaa hh:mm:ss".</p></div>';
			        break;
			    case 016:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>O id informado ultrapassou o limite de 20 caracteres.</p></div>';
			        break;
			    case 080:
			        return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Já foi enviado uma mensagem de sua conta com o mesmo identificador.</p></div>';
			        break;
			        
			    //enviado multiplos
			    case 200:
			    	return '<div class="alert_success"><p><img src="/img/icon_accept.png" alt="success" class="mid_align"/>Requisição aceita pela Human Gateway.</p></div>';
			    	break;
			    //cuidado
			    case 210:
			    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Durante o envio sua conta chegou ao limite de segurança estabelecido, algumas mensagens já foram salvas e outras não foram. Contate nosso suporte para liberação do limite.</p></div>';
			    	break;
			    //erros no arquivo
			    case 240:
			    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo vazio ou não enviado.</p></div>';
			    	break;
			    case 241:
			    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo muito grande (mais de 1Mbyte).</p></div>';
			    	break;
			    case 242:
			    	return '<div class="alert_warning"><p><img src="/img/icon_warning.png" alt="success" class="mid_align"/>Arquivo corrompido ou mal formatado.</p></div>';
			    	break;
			    //enviado multiplos
			    
				//erros.
			    case 900:
			        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Erro de autenticação em "account" e/ou "code".</p></div>';
			        break;
			    case 990:
			        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Seu limite de segurança foi atingido. Contate nosso suporte para verificação/liberação.</p></div>';
			        break;
			    case 998:
			        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Foi invocada uma operação inexistente.</p></div>';
			        break;
			    case 999:
			        return '<div class="alert_error"><p><img src="/img/icon_error.png" alt="delete" class="mid_align"/>Erro desconhecido. Contate nosso suporte.</p></div>';
			        break;
			     
			}
	}
	
	public function enviarIndividual($id,$numero,$mensagem,$assinatura){
		$somenteNumero = $this->somenteNumero($numero);
		
		$mensagem = utf8_decode($mensagem);
		
		$mobile = '55'.$somenteNumero;
		
		//Zend_Debug::dump($mobile);die;
		
		$msg = URLEncode($mensagem);

		try{
			/*$response = fopen("http://system.human.com.br/GatewayIntegration/msgSms.do?dispatch=send&account=vendepubli&code=vxzc3eYfTr&to=".$mobile."&msg=".$msg."&from=".$assinatura."&id=".$id, "r");
			*/
			$ch = curl_init();

			curl_setopt($ch, CURLOPT_URL, "http://system.human.com.br/GatewayIntegration/msgSms.do?dispatch=send&account=vendepubli&code=vxzc3eYfTr&to=".$mobile."&msg=".$msg."&from=".$assinatura."&id=".$id);			
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			// Acessar a URL e retornar a saída
			$output = curl_exec($ch);
			
			// liberar
			curl_close($ch);
			
			// Imprimir a saída
			//echo $output;
		
			//$status_code = fgets($response,4);
		}catch(Exception $e){
			Zend_Debug::dump("Erro: ".$e);
		}
		$status_code = 000;
				/*$sms = new SMS();
				$sms->setMensagem($mensagem);
				$sms->setUsuario_id_envio(0);
				$sms_id = $sms->save();
				
				$enviado = new Enviado();
				$enviado->setSms_id($sms_id);
				$enviado->setStatus($status_code);
				$enviado->setUsuario_id_destinatario($id);
				$enviado->save();*/
		
		return $status_code;
	}
	
	//Cria o arquivo CSV
	public function criarCSVMultiplo($data){
		
			$schedule = date('d/m/y H:i:s');
				
				//Registrar todos os envios pela hora enviada
				$data_csv = str_replace(array('/',' ',':'), '_', $schedule);										
				$csv = fopen('csv/sms.vendepub.'.$data_csv.'.csv', "w");
				
				if(count($data['clientes'])>1){
					$i = 0;
					foreach($data['clientes'] as $id){
						$cliente = new Cliente();
						$cliente = $cliente->getAsArray($id);
						
						//Retira todos os caracteres e retorna somente números
						$cel = $this->somenteNumero($cliente['cel']);
						//Tratar data de acordo com o padrão da Human
						$nome = explode(' ',$cliente['nome']);
						$msg = 'Prezado '.$nome[0].', '.$data['mensagem'];
						
						$string = '55'.$cel.';'.$msg.';'.$cliente['id'].';'.$data['assinatura'];
						fwrite($csv, "{$string}\r\n"); 
						$i++;
					}

					fclose($csv);
					
					//Deu certo!
					return $data_csv;
			}
	}
	
	/*public function enviarMultiplos($data){
		
		$data_csv = $this->criarCSVMultiplo($data);
		
		$arquivo = 'csv/sms.vendepub.'.$data_csv.'.csv';
		$msg_list = file($arquivo);
		
		$numbers='';
		$i=0;
		foreach ($msg_list as $line_num => $line) {
			$line = explode(';', $line);
			$numbers[$i]['numero']    =$line[0];
			$numbers[$i]['mensagem']  =$line[1];
			$numbers[$i]['id']        =$line[2];
			$numbers[$i]['assinatura']=$line[3];
			
			//Salvar a mensagem em comum para todos os SMS's
			if($i<1){
				$sms = new SMS();
				$sms->setMensagem($numbers[$i]['mensagem']);
				$sms_id = $sms->save();
			}
			
			$status = 000;//$this->enviarIndividual($numbers[$i]['id'], $numbers[$i]['numero'], $numbers[$i]['mensagem'], $numbers[$i]['assinatura']);
			
			//Salvar na tabela enviado
			$enviado = new Enviado();
			$enviado->setSms_id($sms_id);
			$enviado->setStatus($status);
			$enviado->setUsuario_id_destinatario($numbers[$i]['id']);
			$enviado->save();
			
			$i++;
		}
		
	}*/
	
	public function enviarMultiplos($data){

			$i=0;
			if(count($data['clientes'])>1){
					foreach($data['clientes'] as $id){
						$cliente = new Cliente();
						$cliente = $cliente->getAsArray($id);
						
						//Retira todos os caracteres e retorna somente números
						$cel = $this->somenteNumero($cliente['celular']);
						//Tratar data de acordo com o padrão da Human
						$nome = explode(' ',$cliente['nome']);
						$msg = 'Prezado(a) '.$nome[0].', '.$data['mensagem'];
						
						$this->enviarIndividual($cliente['id'], $cel, $msg, $data['assinatura']);
						
						$numbers[$i]['numero']    =$cliente['id'];
						$numbers[$i]['mensagem']  =$cel;
						$numbers[$i]['id']        =$msg;
						$numbers[$i]['assinatura']=$data['assinatura'];
						
						$i++;
					}
			}
		
			return '000';
		//Zend_Debug::dump($numbers);die;
	
	}
}

