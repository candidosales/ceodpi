<?php
class Participante extends CSG_Db_DomainObjectAbstract{

    protected $_mapper = "ParticipanteMapper";
    private $nome = null;
    private $cpf = null;
    private $email = null;
    private $data_participacao = null;
    
    private $value1 = null;
    private $value2 = null;
    private $value3 = null;
    private $value4 = null;
    private $value5 = null;
    private $value6 = null;
    private $value7 = null;
    private $value8 = null;
    private $value9 = null;
    private $value10 = null;
    private $value11 = null;
    private $value12 = null;
    private $value13 = null;
    private $value14 = null;
    private $value15 = null;
    private $value16 = null;
    private $value17 = null;
    private $value18 = null;
    private $value19 = null;
    private $value20 = null;
    private $value21 = null;
    private $value22 = null;
    private $value23 = null;
    private $value24 = null;
    
    //1 - Instituição de Ensino de Comunicação
    public function setValue1($value1){	$this->value1 = $value1;   }
    public function getValue1(){return $this->value1;  }
    
    //2 - Professor de comunicação
    public function setValue2($value2){
    	$this->value2 = $value2;
    }
    public function getValue2(){
    	return $this->value2;
    }
    
    //3 - Agência de publicidade
    public function setValue3($value3){
    	$this->value3 = $value3;
    }
    public function getValue3(){
    	return $this->value3;
    }
    
    //4 - Veículo de comunicação eletrônico (TV, rádio e internet)
    public function setValue4($value4){
    	$this->value4 = $value4;
    }
    public function getValue4(){
    	return $this->value4;
    }
    
    //5 - Veículo de comunicação impresso (jornal e revista)
    public function setValue5($value5){
    	$this->value5 = $value5;
    }
    public function getValue5(){
    	return $this->value5;
    }
    
    //6 - Anunciante
    public function setValue6($value6){
    	$this->value6 = $value6;
    }
    public function getValue6(){
    	return $this->value6;
    }
    
    //7 - Jinglista
    public function setValue7($value7){
    	$this->value7 = $value7;
    }
    public function getValue7(){
    	return $this->value7;
    }
    
    //8 - Fotográfo publicitário
    public function setValue8($value8){
    	$this->value8 = $value8;
    }
    public function getValue8(){
    	return $this->value8;
    }
    
    //9 - Produtora de vídeo
    public function setValue9($value9){
    	$this->value9 = $value9;
    }
    public function getValue9(){
    	return $this->value9;
    }
    
    //10 - Produtora de aúdio
    public function setValue10($value10){
    	$this->value10 = $value10;
    }
    public function getValue10(){
    	return $this->value10;
    }
    
    //11 - Gráfica
    public function setValue11($value11){
    	$this->value11 = $value11;
    }
    public function getValue11(){
    	return $this->value11;
    }
    
    //12 - Empresa de mídia exterior
    public function setValue12($value12){
    	$this->value12 = $value12;
    }
    public function getValue12(){
    	return $this->value12;
    }
    
    //13 - Empresa de comunicação visual
    public function setValue13($value13){
    	$this->value13 = $value13;
    }
    public function getValue13(){
    	return $this->value13;
    }
    
    //14 - Profissional de mídia
    public function setValue14($value14){
    	$this->value14 = $value14;
    }
    public function getValue14(){
    	return $this->value14;
    }
    
    //15 - Profissional de marketing
    public function setValue15($value15){
    	$this->value15 = $value15;
    }
    public function getValue15(){
    	return $this->value15;
    }
    
    //16 - Profissional de marketing político
    public function setValue16($value16){
    	$this->value16 = $value16;
    }
    public function getValue16(){
    	return $this->value16;
    }
    
    //17 - Redator publicitário
    public function setValue17($value17){
    	$this->value17 = $value17;
    }
    public function getValue17(){
    	return $this->value17;
    }
    
    //18 - Diretor de arte
    public function setValue18($value18){
    	$this->value18 = $value18;
    }
    public function getValue18(){
    	return $this->value18;
    }
    
    
    //19 - Atendimento publicitário
    public function setValue19($value19){
    	$this->value19 = $value19;
    }
    public function getValue19(){
    	return $this->value19;
    }
    
    //20 - Planejamento de comunicação
    public function setValue20($value20){
    	$this->value20 = $value20;
    }
    public function getValue20(){
    	return $this->value20;
    }
    
    //21 - Instituto de pesquisa de mercado
    public function setValue21($value21){
    	$this->value21 = $value21;
    }
    public function getValue21(){
    	return $this->value21;
    }
    
    //22 - Blog de publicidade
    public function setValue22($value22){
    	$this->value22 = $value22;
    }
    public function getValue22(){
    	return $this->value22;
    }
    
    //23 - Profissional de comunicação de veículo
    public function setValue23($value23){
    	$this->value23 = $value23;
    }
    public function getValue23(){
    	return $this->value23;
    }
    
    //24 - Profissional de novas mídias
    public function setValue24($value24){
    	$this->value24 = $value24;
    }
    public function getValue24(){
    	return $this->value24;
    }
    
    public function setNome($nome){
    	$this->nome = $nome;
    }
    
    public function getNome(){
    	return $this->nome;
    }
    
    public function setCpf($cpf){
    	$this->cpf = $cpf;
    }
    
    public function getCpf(){
    	return $this->cpf;
    }
    
    public function setEmail($email){
    	$this->email = $email;
    }
    
    public function getEmail(){
    	return $this->email;
    }
    
    public function setData_participacao($data_participacao){
    	$this->data_participacao = $data_participacao;
    }
    
    public function getData_participacao(){
    	return $this->data_participacao;
    }
    
    public function getParticipantePorCpf($cpf){
    	return $this->getMapper()->getDb()->fetchAll('SELECT p.* FROM participante p WHERE p.cpf like "%'.$cpf.'%" ');
    }
}