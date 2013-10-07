<?php 

class Twitter
{
	protected $_config;
	protected $_twitter;
	
	public function __construct()
	{
		$config = new Zend_Config_Ini(
		APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
		$this->_config = $config->service->twitter->oauth;
		$this->_twitter = new Zend_Service_Twitter();
	}
	
	public function authenticate()	{
		$accessToken = new Zend_Oauth_Token_Access();
		$accessToken->setToken($this->_config->oauth_token)->setTokenSecret($this->_config->oauth_token_secret);
		
		$this->_twitter->setLocalHttpClient($accessToken->getHttpClient($this->_config->toArray()));
		return $this->_twitter->account->verifyCredentials(); 
	
	} 
	
	public function getTwitter() {
		 return $this->_twitter; 
	} 
}
