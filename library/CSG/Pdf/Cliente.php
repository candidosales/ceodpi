<?php
class CSG_Pdf_Cliente{

	public $html;
	
	public function __construct($data=null){
		
		$titulo = null;
		$clientes = new Cliente();
		$evento = new CSG_Evento_Object();
		
		//Zend_Debug::dump($data['tipo_pdf']);die;
		
		if(!empty($data['tipo_pdf'])){
			if($data['tipo_pdf']=='todos'){
				$clientes = $clientes->getTodosClientesAZ();
				$titulo = 'LISTA DE TODOS OS INSCRITOS';
			}elseif($data['tipo_pdf']=='pagos'){
				$clientes = $clientes->getTodosClientesPagosAZ();
				$titulo = 'LISTA DE TODOS OS INSCRITOS PAGOS';
			}elseif($data['tipo_pdf']=='nao_pagos'){
				$clientes = $clientes->getTodosClientesNaoPagosAZ();
				$titulo = 'LISTA DE TODOS OS INSCRITOS NÃO PAGOS';
			}
		}else{
			$clientes = $clientes->getTodosClientesAZ();
			$titulo = 'LISTA DE TODOS OS INSCRITOS';
		}

        //hoje
		date_default_timezone_set('America/Fortaleza');
        $hoje = Zend_Date::now('pt_BR');       
	 	$body='';
	 	$body1='';
	 	$final='';
	 	$table='';
	 	//Inicio do Corpo - HTML
	
    
   $body.='
   
	<htmlpageheader name="myheader">
	<table width="100%" style="border-bottom:1px solid #ccc;margin-bottom:50px;font-family: Arial;">
	<tr>
		<td width="100px" style="color:#000; font-size: 10pt;">
			<img src="'.$evento->getPdf()->cabecalho_image.'" width="170" height="80" style="background:#ccc;width:100px;height:80px"></img>
		</td>
		<td style="color:#000; font-size: 8pt;">
			<span style="font-weight: bold; font-size: 14pt;">'.$evento->getNomeEvento().'</span><br />'.$evento->getSubTitulo().'<br />Teresina-PI<br/>
			
		</td>
		<td width="280px" style="color:#000; font-size: 8pt;">
			<p style="float:right" class="textright "><i>Teresina(PI), '.$hoje->toString("dd 'de' MMMM 'de' Y 'às' HH'h'mm'm'ss's'").'</i></p>
		</td>
	</tr>
	</table>
	</htmlpageheader>
	
	<htmlpagefooter name="myfooter">
		<div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
			Página {PAGENO} de {nb} - Vende Publicidade
		</div>
	</htmlpagefooter>
	
	<sethtmlpageheader name="myheader" value="on" show-this-page="1" />
	<sethtmlpagefooter name="myfooter" value="on" />
	
   
   <div id="content" >';
   
   	$table.='<table id="clientes" width="100%">
							<thead>
								<tr style="border-bottom:1px solid #ccc;">
									<th width="15%" scope="col" colspan="4" style="border-bottom:1px solid #ccc;">
										'.$titulo.'
									</th>
								</tr>
								<tr>
									<th width="15%" scope="col">Nome</th>					
									<th width="15%" scope="col">E-mail</th>
									<th width="15%" scope="col">Cidade - Estado</th>
									<th width="15%" scope="col">Celular</th>
								</tr>
							</thead>
							<tbody>';   
   
   	
   	/*
   	 * Incluir depois do </thead> e antes do <tbody> para rodapé que se repete em todas as tabelas de cada página
   	 * <tfoot>
   	<tr>
   	<td colspan="4">
   	<em>'.$evento->getNomeEvento().'</em>
   	</td>
   	</tr>
   	</tfoot>*/
   	
   $i = 0;
   	
   foreach($clientes as $c){
   	if($c->confirma_pagamento!=0){
   		if($i % 2){
			$table.= '<tr class="verde-par">';
	   	}else{
	   		$table.= '<tr class="verde-impar">';
	   	}
   	}else{
   			   	if($i % 2){
					$table.= '<tr class="par">';
			   	}else{
			   		$table.= '<tr class="impar">';
			   	}
   	}
   	if($c->confirma_pagamento!=0){	   	 	
	   	 	$table.= '<td width="15%"> <img src="/img/icon/success2.png" style="padding-right:10px"></img>'.$c->nome.'</td>';
   	}else{
   			$table.= '<td width="15%">'.$c->nome.'</td>';
   	}
		/*	$table.= '<td>'.$c->cpf.'</td>';
			$table.= '<td>'.$c->rg.'</td>';
			$table.= '<td>'.$c->tipo.'</td>';		
	
			if($c->instituicao){
				$table.= '<td>'.$c->instituicao.'</td>';
			}elseif($c->empresa){
				$table.= '<td>'.$c->empresa.'</td>';
			}

			$table.= '<td>'.$c->tipo_participacao.'</td>';*/
			$table.= '<td width="15%">'.$c->email.'</td>';
			$table.= '<td width="15%">'.$c->cidade.' - '.$c->estado.'</td>';
			$table.= '<td width="15%">'.$c->celular.'</td>';
	   		/*if($c->confirma_pagamento!=0){
				$table.= '<td>Sim</td>';
			}else{
				$table.= '<td>NÃ£o</td>';
			}*/
		$table.= '</tr>';
		$i++;
   }
   
 	$table.='</tbody>
			 </table>';
    	
    $final.='</div>';
    	
   	$this->html.= $body.$table.$final;
   		
    } 
        
        public function getHtml(){
        	return $this->html;
        }
}