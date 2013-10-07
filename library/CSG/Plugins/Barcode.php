<?php

class CSG_Plugins_Barcode extends Zend_Controller_Plugin_Abstract {
	
	public function create( $value, $options = array(), $barcodetype = 'code39', $type = 'image' )
		{
		// Somente o texto é obrigatório para a criação
		$barcodeOptions = array( 'text' => $value );
		// Junta a configuração padrão e o $options informado, que são os valores de configuração padrão do Zend_Barcode
		$barcodeOptions = array_merge( $barcodeOptions, $options );
		
		// Não obrigatório, para retornar em JPG usa-se: 'imageType' => 'jpg'
		$rendererOptions = array();
		
		// Para criar uma imagem, faltando só colocar os headers, o padrão de imagem é PNG
		return Zend_Barcode::render( $barcodetype, $type, $barcodeOptions, $rendererOptions );
		}
}