<?php
class CSG_Evento_Object
{
	protected $_evento;
	
	public function __construct()
	{
		$config = Zend_Registry::get('evento');
		$this->_evento = ($config->evento);
	}
	
	public function getQuantidadeVagas(){
		return intval($this->_evento->quantidade->vagas);
	}
	
	public function getValores(){
		return (array) $this->_evento->valor->toArray();
	}
	
	public function getValorInicial(){
		return intval($this->_evento->valor_inicial);
	}
	
	public function getPrazosDiasAntes(){
		return $this->_evento->prazo->dias_antes->toArray();
	}
	
	public function getDataEncerraInscricao(){
		return $this->_evento->data->encerra_inscricao;
	}
	
	public function getNomeEvento(){
		return $this->_evento->nome_evento;
	}
	
	public function getSubTitulo(){
		return $this->_evento->subtitulo;
	}
	
	public function getAssinaturaSms(){
		return $this->_evento->assinatura_sms;
	}
	
	public function getTitle(){
		return $this->_evento->title;
	}
	
	public function getDescription(){
		return $this->_evento->description;
	}
	
	public function getPdf(){
		return $this->_evento->pdf;
	}
	
	public function getFont(){
		return $this->_evento->font;
	}
	
	public function getFormaPagamento(){
		return $this->_evento->forma_pagamento;
	}
	
	public function getCertificadoTextTop(){
		return intval($this->_evento->certificado->text_top);
	}
	
	public function getCertificadoTextLeft(){
		return intval($this->_evento->certificado->text_left);
	}
	
	public function getCertificadoFont(){
		return $this->_evento->certificado->font;
	}

	public function getCertificadoImagem(){
		return $this->_evento->certificado->imagem;
	}
	
	public function getOpcaoCategoria(){
		return (array) $this->_evento->opcao->categoria->toArray();
	}
	
	public function getOpcaoValor(){
		return (array) $this->_evento->opcao->valor->toArray();
	}
	
	public function getOpcaoLocal(){
		return (array) $this->_evento->opcao->local->toArray();
	}
	
	public function getContatoEmail(){
		return (string) $this->_evento->contato->email;
	}
	
	public function getEmailMktImage(){
		return $this->_evento->emailmkt->image;
	}
	
	public function getEmailMktCor(){
		return $this->_evento->emailmkt->cor;
	}

	public function getUrlInstagram(){
		return $this->_evento->url->instagram;
	}
	
	public function getUrlTwitter(){
		return $this->_evento->url->twitter;
	}
	
	public function getUrlFacebook(){
		return $this->_evento->url->facebook;
	}
	
	public function getUrlFlickr(){
		return $this->_evento->url->flickr;
	}

	public function getUrlSite(){
		return $this->_evento->url->site;
	}
	
	public function getSite(){
		return $this->_evento->site;
	}

	public function getMoipIdcarteira(){
		return $this->_evento->moip->id_carteira;
	}
}