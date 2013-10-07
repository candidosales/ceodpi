<?php

class CSG_View_Helper_Data extends Zend_View_Helper_Abstract
{
    public $extenso;
    public $convert;
    public $pt_br;
    public $hora;

    public function data($data)
    {
    	if (strstr($data, "/"))//verifica se tem a barra /
		{
			$d = explode ("/", $data);//tira a barra
			$convert = "$d[2]-$d[1]-$d[0]";//separa as datas $d[2] = ano $d[1] = mes etc...
			return $this->convert;
		}elseif(strstr($data, "-")){
			$d = explode ("-", $data);
			$convert = "$d[2]/$d[1]/$d[0]";
			return $this->convert;
		}else{
			return "Data invalida";
		}
    }
    
	/*public function data($data)
    {
        list($ano, $mes, $dia) = explode("-", substr($data, 0, 10));

        $this->extenso = $this->diasemana("$ano-$mes-$dia");
        $this->pt_br = "$dia/$mes/$ano";

        if(strlen($data)>10){
            list($hora, $minuto, $segundo) = explode(":", substr($data, 11, 8));
            $this->hora = "$hora:$minuto:$segundo";
        }

        return $this;
    }

    /**
     * Retorna o dia da semana, por extenso e em português, correspondente
     * a data informada por parametro (no padrão aaaa-mm-dd).
     *
     * @param Date $data
     * @return String
     */
    public function diasemana($data){
        list($ano, $mes, $dia) = explode("-", $data);

        $diasemana = date("w", mktime(0, 0, 0, $mes, $dia, $ano));

        switch($diasemana) {
            case 0: $diasemana = "Domingo";
                    break;
            case 1: $diasemana = "Segunda-Feira";
                    break;
            case 2: $diasemana = "Terça-Feira";
                    break;
            case 3: $diasemana = "Quarta-Feira";
                    break;
            case 4: $diasemana = "Quinta-Feira";
                    break;
            case 5: $diasemana = "Sexta-Feira";
                    break;
            case 6: $diasemana = "Sábado";
                    break;
        }

        return $diasemana;

    }
}
