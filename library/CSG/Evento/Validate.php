<?php
class CSG_Evento_Validate{
	
    static function validarFormulario($data){
    	
    	 	$cliente = new Cliente();
	  		$totalCliente = $cliente->getTotalClientesPagos();
	  		
	  		$evento = new CSG_Evento_Object();
	  		
	  		$erros = null;
			$erros['qtd'] = 0;

	  		if(!(intval($totalCliente->pagos) - $evento->getQuantidadeVagas() < 0)){
	  			$erros['valida'][$erros['qtd']] = 'Desculpa, mas as inscrições já estão encerradas. Não temos mais vagas.';
				$erros['qtd']++;
	  		}
    	
			if(empty($data['nome'])){
				$erros['valida'][$erros['qtd']] = 'Por favor, insira seu nome completo';
				$erros['qtd']++;
			}
			
			
			if(empty($data['cpf'])){
				$erros['valida'][$erros['qtd']] = 'Por favor, insira seu CPF';
				$erros['qtd']++;
			}else{
				$data['cpf'] = CSG_SMS_Send::somenteNumero($data['cpf']);
				if(!CSG_Evento_Validate::validarCPF($data['cpf'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira um CPF válido';
					$erros['qtd']++;
				}
			}
				
			if(empty($data['rg'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu RG';
					$erros['qtd']++;
				}
			if(empty($data['endereco'])){
					$erros['valida'][$erros['qtd']] = 'Por favor, insira seu endereço';
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
	
	
 	static function retirarAcentos($string){
	    $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞ
	ßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
	    $b = 'aaaaaaaceeeeiiiidnoooooouuuuy
	bsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
	    $string = utf8_decode($string);    
	    $string = strtr($string, utf8_decode($a), $b);
	    ///$string = strtolower($string);
	    return utf8_encode($string);
	}

	// Função que valida o CPF
	static function validarCPF($cpf)
	{	// Verifiva se o número digitado contém todos os digitos
	    $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);
		
		// Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
	    if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999')
		{
		return false;
	    }
		else
		{   // Calcula os números para verificar se o CPF é verdadeiro
	        for ($t = 9; $t < 11; $t++) {
	            for ($d = 0, $c = 0; $c < $t; $c++) {
	                $d += $cpf{$c} * (($t + 1) - $c);
	            }
	
	            $d = ((10 * $d) % 11) % 10;
	
	            if ($cpf{$c} != $d) {
	                return false;
	            }
	        }
	
	        return true;
	    }
	}
	
	static function formatoDinheiroMoip($data){
	    $locale = new Zend_Locale('pt_BR');
    
		    $stringA= strval($data);		    
			$stringB=".";
			$length=strlen($stringA);
			$temp1=substr($stringA,0,$length-2);
			$temp2=substr($stringA,$length-2,$length);
			$number = intval($temp1.$stringB.$temp2); 
		    
			$number = Zend_Locale_Format::toNumber($number,array('locale' => $locale));

    	 return $number;
	}
	
	static function money_format($format, $number)
	{
		$regex  = '/%((?:[\^!\-]|\+|\(|\=.)*)([0-9]+)?'.
				'(?:#([0-9]+))?(?:\.([0-9]+))?([in%])/';
		if (setlocale(LC_MONETARY, 0) == 'C') {
			setlocale(LC_MONETARY, '');
		}
		$locale = localeconv();
		preg_match_all($regex, $format, $matches, PREG_SET_ORDER);
		foreach ($matches as $fmatch) {
			$value = floatval($number);
			$flags = array(
					'fillchar'  => preg_match('/\=(.)/', $fmatch[1], $match) ?
					$match[1] : ' ',
					'nogroup'   => preg_match('/\^/', $fmatch[1]) > 0,
					'usesignal' => preg_match('/\+|\(/', $fmatch[1], $match) ?
					$match[0] : '+',
					'nosimbol'  => preg_match('/\!/', $fmatch[1]) > 0,
					'isleft'    => preg_match('/\-/', $fmatch[1]) > 0
			);
			$width      = trim($fmatch[2]) ? (int)$fmatch[2] : 0;
			$left       = trim($fmatch[3]) ? (int)$fmatch[3] : 0;
			$right      = trim($fmatch[4]) ? (int)$fmatch[4] : $locale['int_frac_digits'];
			$conversion = $fmatch[5];
	
			$positive = true;
			if ($value < 0) {
				$positive = false;
				$value  *= -1;
			}
			$letter = $positive ? 'p' : 'n';
	
			$prefix = $suffix = $cprefix = $csuffix = $signal = '';
	
			$signal = $positive ? $locale['positive_sign'] : $locale['negative_sign'];
			switch (true) {
				case $locale["{$letter}_sign_posn"] == 1 && $flags['usesignal'] == '+':
					$prefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 2 && $flags['usesignal'] == '+':
					$suffix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 3 && $flags['usesignal'] == '+':
					$cprefix = $signal;
					break;
				case $locale["{$letter}_sign_posn"] == 4 && $flags['usesignal'] == '+':
					$csuffix = $signal;
					break;
				case $flags['usesignal'] == '(':
				case $locale["{$letter}_sign_posn"] == 0:
					$prefix = '(';
					$suffix = ')';
					break;
			}
			if (!$flags['nosimbol']) {
				$currency = $cprefix .
				($conversion == 'i' ? $locale['int_curr_symbol'] : $locale['currency_symbol']) .
				$csuffix;
			} else {
				$currency = '';
			}
			$space  = $locale["{$letter}_sep_by_space"] ? ' ' : '';
	
			$value = number_format($value, $right, $locale['mon_decimal_point'],
					$flags['nogroup'] ? '' : $locale['mon_thousands_sep']);
			$value = @explode($locale['mon_decimal_point'], $value);
	
			$n = strlen($prefix) + strlen($currency) + strlen($value[0]);
			if ($left > 0 && $left > $n) {
				$value[0] = str_repeat($flags['fillchar'], $left - $n) . $value[0];
			}
			$value = implode($locale['mon_decimal_point'], $value);
			if ($locale["{$letter}_cs_precedes"]) {
				$value = $prefix . $currency . $space . $value . $suffix;
			} else {
				$value = $prefix . $value . $space . $currency . $suffix;
			}
			if ($width > 0) {
				$value = str_pad($value, $width, $flags['fillchar'], $flags['isleft'] ?
						STR_PAD_RIGHT : STR_PAD_LEFT);
			}
	
			$format = str_replace($fmatch[0], $value, $format);
		}
		return $format;
	}
}