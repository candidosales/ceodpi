<?php
class CSG_Pdf_GerarCertificado{

	protected $mpdf;

	public function __construct($data=null){

		ini_set("memory_limit","192M");
		
		//Zend_Debug::dump($data);die;
		
				$cliente = $data;
		
				include("../library/MPDF57/mpdf.php");
					
				// create object mpdf
				//...,top,x)
				
				$evento = new CSG_Evento_Object();
					
				$mpdf = new mPDF('win-2152','A4-L','','',20,15,35,25,10,10, 'L');
				$mpdf->allow_charset_conversion=true;
				$mpdf->SetTitle($evento->getNomeEvento().' - Certificado - '.$cliente->nome);
				$mpdf->SetAuthor($evento->getNomeEvento());
				$mpdf->SetCreator($evento->getNomeEvento());
				$mpdf->SetSubject($evento->getNomeEvento().' - Certificado - '.$cliente->nome);
		
			
				$htmlPdf = new CSG_Pdf_Certificado($cliente->nome);
				
				//Zend_Debug::dump(file_get_contents('css/pdf.css'));die;
				// inclui css

				$css = file_get_contents('css/certificado.css');
				$mpdf->WriteHTML($css,1);
				$body = $htmlPdf->getHtml();
				
				//print_r($body);die;
		
				$mpdf->WriteHTML($body,2);
		
				// Output pdf
				$nome = str_replace(' ', '_', $cliente->nome);
				$mpdf->Output('Certificado-'.$nome.'-'.date('d_m_y-H_i_s').'.pdf','D');
				$mpdf->debug = true;
				$mpdf->Output();	
	}

}