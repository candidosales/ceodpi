<?php
class CSG_Premiacao_Validate{
	
    static function validarFormulario($data){
	  		
	  		$erros = null;
			$erros['qtd'] = 0;

    	
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
							
			return $erros;
    }

}