<?php
class CSG_Pdf_Certificado{

	public $html;

	public function __construct($data=null){
		
		$evento = new CSG_Evento_Object();
		
		
		$body.='<p class="bold size_18" style="font-family:'.$evento->getCertificadoFont().';padding:'.$evento->getCertificadoTextTop().' 0 0 '.$evento->getCertificadoTextLeft().'">'.$data.'</p>';
		
		$this->html.= $body;
		
	}
	
	public function getHtml(){
		return $this->html;
	}
}