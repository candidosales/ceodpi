<?php
class CSG_Evento_Service{

     static function enviarEmail($data){
     	
     	$evento = new CSG_Evento_Object();
    	
    		$html = CSG_Evento_Service::mensagemEmail($data, $evento);
    	
    		$settings = array('ssl'=>'ssl',
                                'port'=>465,
                                'auth' => 'login',
                                'username' => 'ceodpi@vendepublicidade.com.br',
                                'password' => 'ceodpi22the');
            $transport = new Zend_Mail_Transport_Smtp('smtp.gmail.com', $settings);
            $email_from = $evento->getContatoEmail();
            $name_from = $evento->getNomeEvento();
            $email_to = $data['email'];
            $name_to = $data['nome'];

            $mail = new Zend_Mail('UTF-8');
            $mail->setHeaderEncoding(Zend_Mime::ENCODING_BASE64);
            $mail->setReplyTo($email_from, $name_from);
            $mail->setFrom ($email_from, $name_from);
            $mail->addTo ($email_to, $name_to);
            $mail->setSubject ($evento->getNomeEvento());
            $mail->setBodyHtml($html);
            $mail->send($transport);
            
            return true;
    }
    
    function mensagemEmail($data, $evento){
    	
    	
    	$html = '<div style="width:100%;height:100%;font-family:Arial">
			<div style="margin:20px auto 0 auto;padding:0 20px;width:500px;height:400px;border-left:1px solid #eeeeee;border-right:1px solid #eeeeee">
				<div style="height:125px;width:100%;background:transparent;border-bottom:2px solid '.$evento->getEmailMktCor().';padding-bottom:10px;">
					<a title="'.$evento->getNomeEvento().'" href="'.$evento->getSite().'" target="_blank">
						<img width="500px" height="125px" src="'.$evento->getEmailMktImage().'"></img>
					</a>
				</div>
				<div style="height:200px;width:100%;padding:0 10px">';
    	
    	switch($data['tipo_mensagem']){
    		case 'inscricao':
    			$html.='
					<p style="font-weight:bold;color:'.$evento->getEmailMktCor().';font-size:18px;font-family:Arial">Sr(a). '.$data['nome'].',</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						<strong>Parabéns</strong>, por se inscrever em nosso Congresso Estadual da Ordem DeMolay Piauiense.
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Efetue logo seu pagamento e garanta a sua vaga.
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Aguardamos <strong>seu pagamento até 3 dias após sua inscrição</strong>, caso contrário, você perderá sua vaga.
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Você pode acompanhar notícias sobre o evento por meio das nossas redes sociais.
					</p>';
    		break;
    		
    		case 'pagamento':
    			$html.='<p style="font-weight:bold;color:'.$evento->getEmailMktCor().';font-size:18px;font-family:Arial">Sr(a). '.$data['nome'].',</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Obrigado por efetuar o pagamento de sua inscrição.
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Agora é só aguardar dia 6 de dezembro.
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Você pode acompanhar notícias sobre o evento por meio das nossas redes sociais.
					</p>';
    		break;
    		
    		case 'relatorio':
    			$html.='<p style="font-weight:bold;color:'.$evento->getEmailMktCor().';font-size:18px;font-family:Arial">Estimado Organizador,</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Segue abaixo os últimos pagamentos realizados pelo sistema de Pagamento <a style="color:#1265a9;font-weight:bold;text-decoration:none" href="http://www.moip.com.br" target="_blank" title="MoIP">MoIP</a>:
					</p>
					<table style="margin:0 10%">
						<tr style="color:#fff;font-size:12px;background:#174d33;text-align:center">
						  <th style="padding:5px;">N°</th>
						  <th style="padding:5px;">Nome</th>
						  <th style="padding:5px;">Valor (R$)</th>
						  <th style="padding:5px;">Data Pag.</th>
						</tr>';
    			
						$i = 1;
						$valor = 0;    

						//Zend_Debug::dump($data);die;
    					foreach($data as $d){
    						
    						if(!isset($d->cliente_id) && ($d->confirma_pagamento == '1')){
	    						//É par ou impar
	    						if($i&1){
	    							$html.='<tr style="paddding:5px;font-size:12px">';
	    						}else{
	    							$html.='<tr style="background:#ddd;paddding:5px;font-size:12px">';
	    						}
	    						
	    						$date = new Zend_Date($d->data_confirma_pagamento);
	    						
		    					$html.='  <td style="padding:5px;">'.$i.'</td>
										  <td style="padding:5px;">'.$d->nome.'</td>
										  <td style="padding:5px;">'.(intval($d->valor)/100).',00</td>
										  <td style="padding:5px;">'.$date->toString('dd/MM/yyyy HH:mm:ss').'</td>
										</tr>';
		    					$valor += intval($d->valor);
		    					$i++;
    						}
    					}
    					
    					$valor = CSG_Evento_Validate::formatoDinheiroMoip($valor);
    					
					$html.='</table>
					
					<p style="font-size:18px;font-family:Arial;line-height:18px">
						Valor total: <strong>R$ '.$valor.',00</strong>
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Acesse o administrador do sistema para maiores detalhes: <a title="Gerenciador do evento" style="color:#1265a9;font-weight:bold;text-decoration:none" href="http://www.marketingpoliticopiaui.com/admin">link</a>
					</p>
					<p style="font-size:14px;font-family:Arial;line-height:18px">
						Você pode acompanhar notícias sobre o evento e política por meio das nossas redes sociais.
					</p>';
    		break;
    	}
    	
    	$html.='<ul style="list-style:none;float:left;padding:0;margin:0;width:100%;overflow:hidden;">
						<li style="float:left;margin:0;padding:0 15px 0 0">
							<a title="Siga nosso twitter" target="_blank" href="'.$evento->getUrlTwitter().'">
								<img width="32" height="32" style="float:left;" src="'.$evento->getUrlSite().'/img/email/twitter.png"></img>
							</a>
						</li>
						<li style="float:left;margin:0;padding:0 15px 0 0">
							<a title="Acompanhe nosso facebook!" target="_blank"  href="'.$evento->getUrlFacebook().'">
								<img width="32" height="32" style="float:left" src="'.$evento->getUrlSite().'/img/email/facebook.png"></img>
							</a>
						</li>
						<li style="float:left;margin:0;padding:0 15px 0 0">
							<a title="Acompanhe nosso instagram!" target="_blank"  href="'.$evento->getUrlInstagram().'">
								<img width="32" height="32" style="float:left" src="'.$evento->getUrlSite().'/img/email/instagram.png"></img>
							</a>
						</li>
						<li style="float:left;margin:0;">
							<a title="Envie-nos um e-mail" href="mailto:'.$evento->getContatoEmail().'">
								<img width="32" height="32" style="float:left;padding:0 0 10px 0" src="'.$evento->getUrlSite().'/img/email/email.png"></img>
								<span style="font-size:14px;float:left;margin:4px 0 0 4px;color:#1265a9;font-weight:bold">'.$evento->getContatoEmail().'</span>
							</a>
						</li>
					</ul>
				</div>
			
			</div>
		</div>';
    	
    	
    	//Zend_Debug::dump($html);
    	
    	return $html;
    }
    
    static function enviarTwitter($data){
    	  $twitterClient = new Twitter();
		  $result = $twitterClient->authenticate();
		  $twitter = $twitterClient->getTwitter();
							
		  $response = $twitter->status->update('Obrigado @'.$data['twitter'].' por se inscrever em nosso Congresso. Por favor, siga @ceodpi para acompanhar sobre o evento.');
		  $response = $twitter->directMessageNew($data['twitter'], 'Obrigado');
		  return $response;
    }
    
    
   static function enviarSms($data){
    
    	$mensagem = 'Obrigado por se inscrever! Estamos aguardando o pagamento e acompanhe novidades facebook.com/ceodpi.';
		$assinatura = 'XICEODPI';
							
		$nome = explode(' ',$data['cliente']->getNome());
		$mensagem = 'Sr(a) '.$nome[0].', '.$mensagem;
							
		$sms = new CSG_SMS_Send();
		$retorno = $sms->enviarIndividual($data['id'],$data['celular'], $mensagem, $assinatura);
					
		if($retorno==000)
			return true;
			
		return false;
    }

}