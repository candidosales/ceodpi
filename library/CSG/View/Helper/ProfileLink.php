<?php
class CSG_View_Helper_ProfileLink
{
    public $view;

    public function setView(Zend_View_Interface $view)
    {
        $this->view = $view;
    }

    public function profileLink()
    {
        $auth = Zend_Auth::getInstance();
        if ($auth->hasIdentity()) {
            $nome = explode(" ",$auth->getIdentity()->nome);
            $regra = $auth->getIdentity()->regra; 
	            return '<div id="account_info">
							'.$this->get_gravatar($auth->getIdentity()->email,25,'mm','g',true).'<a style="padding:0px 5px 0 10px" href="">'.utf8_encode($nome[0]).'</a><!-- (<a href="">1 new message</a>) | <a href="">Setting</a> --> | <a href="/admin/auth/logout">Sair</a>
						</div>
				';   
        }
        return '	<div id="account_info">	</div>	';
    }
    
    function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {

    	$url = 'http://www.gravatar.com/avatar/';
    	$url .= md5( strtolower( trim( $email ) ) );
    	$url .= "?s=$s&d=$d&r=$r";
    	if ( $img ) {
    		$url = '<img src="' . $url . '"';
    		foreach ( $atts as $key => $val )
    			$url .= ' ' . $key . '="' . $val . '"';
    		$url .= ' />';
    	}
    	return $url;
    }
    
}