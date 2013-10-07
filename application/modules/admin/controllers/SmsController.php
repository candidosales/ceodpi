<?php
class Admin_SmsController extends Zend_Controller_Action
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

	public function indexAction() {
	  	$this->view->headTitle()->prepend('Painel do Administrador | SMS');
		$evento = new CSG_Evento_Object();
		$this->view->assinatura_sms = $evento->getAssinaturaSms();
	}
	
	public function ajaxTesteAction() {
		$this->_helper->viewRenderer->setNoRender(); 		
		if ($this->_getAllParams()) {
			$data = $this->_getAllParams();	
			
			$sms = new CSG_SMS_Send();
			$data['cel'] = $sms->somenteNumero($data['cel']);
			$status = $sms->testeSms($data['cel']);
				
			echo $sms->getStatusCode($status);
		}
	}
	
	public function ajaxSelectGrupoAction(){
		$this->_helper->viewRenderer->setNoRender(); 
			$grupo = new Grupo();
			$grupos = $grupo->getGrupos();
			
			if(count($grupos)>0){
				$select = '<option value="0">-- Selecione um grupo --</option>';
				foreach($grupos as $g){
					 $select .='<option value="'.$g->id.'" >'.$g->nome.'</option>';
				}
				echo $select;
			}else{
				echo '<option value="0">Nenhum grupo</option>';	
			}
	}
	
	public function ajaxAdicionarGrupoAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()) {
			
			$resposta = null;
			
			$data = $this->_getAllParams(); 
			$grupo = new Grupo($data);
			$id = $grupo->save();
			if(!empty($id)){
				$resposta['valor'] = '1';
			}else{
				$resposta['valor'] = '0';	
			}
			
			print json_encode($resposta);
		}
	}
	
	public function ajaxClientesPorGrupoAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
				$cliente = new Cliente();
			$clientes = $cliente->getClientesByGrupos();
			$grupos = $cliente->getGruposComClientes();

			$arvore = '<ul id="browser" class="filetree treeview-famfamfam">';
			$j = 0;
			$aux = '1';
			if(count($clientes)>0){
				for($i=0;$i<count($clientes);$i++){
					if(($grupos[$j]->grupo_id == '0') && ($aux == '1')){
						$arvore .= '<li><span class="folder"><input id="'.$j.'" type="checkbox" name="grupo" value="0">Sem Grupo</span>
								   		<ul>';
					}elseif($aux == '1'){
						$arvore .='<li><span class="folder"><input id="'.$j.'" type="checkbox" name="grupo" value="'.$grupos[$j]->grupo_id.'">'.$grupos[$j]->grupo_nome.'</span>
								   		<ul>';
					}
					$aux = '0';
					
					//Variavel para o subgrupo
					$aux2= '1';
					if($clientes[$i]->grupo_id == $grupos[$j]->grupo_id){
						/*if(($clientes[$i]->confirma_pagamento == '1') && ($aux2 == '1')){
							$arvore .= '<li><span class="folder"><input id="'.$j.'" type="checkbox" name="grupo" value="0">Pagos</span>
								   		<ul>';
							
						}*/
						$arvore .='<li>
										<span class="file">
											<input type="checkbox" class="clientes_grupo" name="cliente_'.$j.'" value="'.$clientes[$i]->id.'">
												<a href="/admin/cliente/ver/id/'.$clientes[$i]->id.'">'.$clientes[$i]->nome.'</a>
												
												<a title="Editar os dados de  '.$clientes[$i]->nome.'" href="/admin/cliente/editar/id/'.$clientes[$i]->id.'">
													<img src="/img/icon/edit.png">
												</a>
										</span>
									</li>';
					}else{
						$arvore .='</ul></li>';
						$j++;
						$i--;
						$aux = '1';
					}
				}
				$arvore .= '</ul>';
			}
			
			echo $arvore;
		}
	}
	
	public function ajaxEnviarMensagemAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
			$data = $this->_getAllParams();
			//Zend_Debug::dump($data);die;
	        
			$sms = new CSG_SMS_Send();
	        	
			$data['clientes'] = explode(',', substr($data['clientes'],0,-1));
				
			//Se for mais de um cliente, cria o arquivo csv
			if(count($data['clientes'])>=2){
				
			//Se for selecionado somente 1 cliente não precisa criar arquivo csv
				$retorno = $sms->enviarMultiplos($data);
				return $retorno;
			}else{
				//Mensagem para 1 cliente = OK!		
				if(count($data['clientes'])>0){			
						
					$cliente = new Cliente();
					$cliente = $cliente->getAsArray($data['clientes'][0]);
					
					$nome = explode(' ',$cliente['nome']);
					$mensagem = 'Sr. '.$nome[0].', '.$data['mensagem'];

					$sms = new CSG_SMS_Send();
					$retorno = $sms->enviarIndividual($cliente['id'],$cliente['cel'], $mensagem, $data['assinatura']);
					//$retorno = '000';
					//Zend_Debug::dump($retorno);//die;
					if($retorno == '000'){
						echo '000';
					}else{
						echo $retorno;
					}
				}else{
					echo '002';
				}
			}
		}
	}
	
	public function ajaxDatasRelatorioAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
			$data='';
			$array = null;
			$aux = null;			
			for($i=0;$i<12;$i++){
				//Colocando as datas a serem pesquisadas em um array
				$array[$i] = date('Y-m-d',mktime(0, 0, 0, date("m"),date("d") - $i, date("Y")));
			}
				//Revertendo o array para que as ultimas datas sejam as primeiras
			$array = array_reverse($array);
			
			$enviado = new Enviado();
			$retorno = $enviado->getSMSEnviadosNosXDIas(12);
			$aux2 = null;
			$i = 0;
			foreach($array as $a){
				
				$eIgual = false;
				//Variavel para verificar se a data do array é a mesma vinda do banco. Se for, ele insere no array aux2 os valores vindo do banco.
				
				foreach ($retorno as $sms){		
					$x = new Zend_Date($sms->data_envio);
					//print_r($x->toString('Y-MM-dd').'     '.$a.'<br>');
					
					if($x->toString('Y-MM-dd') == $a){
						$eIgual = true;
						$aux2['sms'][$i]['mensagem'] = $sms->mensagem;
						$aux2['sms'][$i]['qtd_sms_enviado'] = doubleval($sms->qtd_sms_enviado);					
						$aux2['sms'][$i]['data_envio'] = $x->toString('dd/MM');
					}
				}
				
				if($eIgual==false){
					$y = new Zend_Date($a);
					$aux2['sms'][$i]['mensagem'] = '';
					$aux2['sms'][$i]['qtd_sms_enviado'] = 0;					
					$aux2['sms'][$i]['data_envio'] = $y->toString('dd/MM');
					
				}
				$i++;
			}
			print json_encode($aux2);
		}
	}
	
	public function ajaxSmsPorDiaAction(){
		$this->_helper->viewRenderer->setNoRender();
		if ($this->_getAllParams()){
			
		}
	}
	
	public function testeAction() {
		
	  	$this->view->headTitle()->prepend('Painel do Administrador');
	}
}