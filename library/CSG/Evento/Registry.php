<?php

class CSG_Evento_Registry{

	protected $evento;

    public function __construct()
	{
		$this->evento = new CSG_Evento_Object();
	}

	public function calcularValorInscricao($data=null){
	
		if($this->evento->getFormaPagamento()=='pagseguro'){
			//PagSeguro
			$categorias = $this->evento->getOpcaoCategoria();
			$valores = $this->evento->getOpcaoValor();
			
			if($data['tipo'] =='estudante'){
				return $valores[1];
			}
			
			if($data['tipo'] == 'profissional'){
				if($data['filiado']){
					/*if($data['tipo_filiado']=='diretor'){
						return $valores[0];
					}
					if($data['tipo_filiado']=='funcionario'){
						return $valores[1];
					}*/
					return $valores[0];
				}
				return $valores[2];
			}
		}
	
	if($this->evento->getFormaPagamento()=='moip'){
			/* Se Maçom fosse diferenciado
			if($data['tipo']=='2'){
				return '5000';
			}*/
		
		
	      //MoIP
		  $evento = new CSG_Evento_Object();
    	  $prazos = $evento->getPrazosDiasAntes();
    	  $valores = $evento->getValores();
    	  $valor_inicial = $evento->getValorInicial();
    	  $vagas = $evento->getQuantidadeVagas();
    	  
    	  $hoje = new Zend_Date();
    	  $hoje = $hoje->toString('dd/MM/YYYY');
    	  
    	  $dataInicio = new Zend_date($hoje, 'dd/MM/YYYY');
          $dataFim = new Zend_date($evento->getDataEncerraInscricao(),'dd/MM/YYYY' );

          $diferenca = floor( ( $dataFim->getTimestamp() - $dataInicio->getTimestamp() ) / ( 3600 * 24 ) );  
     
	        $valor_boleto = $valor_inicial;
	        
	        $qtd = count($prazos);
	        for($i=0;$i< $qtd;$i++){
		        if($diferenca <= $prazos[$i]){
		        	$valor_boleto = $valores[$i];
		        }
	        }
	        
	       return $valor_boleto;
		}
	}
}