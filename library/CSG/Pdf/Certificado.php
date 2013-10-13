<?php
class CSG_Pdf_Certificado{

	public $html;

	public function __construct($data=null){
		
		$evento = new CSG_Evento_Object();
		
		
		$body.='<div style="position: absolute; left:0; right: 0; top: 0; bottom: 0;z-index:0;">
					<img src="'.$evento->getCertificadoImagem().'" style="width: 210mm; height: 297mm; margin: 0;" />
				</div>
				<p class="bold size_18" style="position:absolute;z-index:1;font-family:'.$evento->getCertificadoFont().';padding:'.$evento->getCertificadoTextTop().' 0 0 '.$evento->getCertificadoTextLeft().'">'.$data.'</p>';
		
		$this->html.= $body;
		
	}
	
	public function getHtml(){
		return $this->html;
	}
}