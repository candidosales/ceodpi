<?php

class CSG_Plugins_CheckAcl extends Zend_Controller_Plugin_Abstract {

    private $_acl = null;

    public function __construct(Zend_Acl $acl) {
        $this->_acl = $acl;
    }

    public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request) {
        $module = $request->getModuleName();
        $resource = $request->getControllerName();
        $action = $request->getActionName();

        if ($module <> "default") {
        	$regra = Zend_Registry::get('regra');
        	//Não tem acesso ao action com a regra fornecida
            if (!$this->_acl->isAllowed(Zend_Registry::get('regra'), $module . ':' . $resource, $action)) {
                $request->setModuleName('admin')
                        ->setControllerName('auth')
                        ->setActionName('acesso-negado');
            }
        }
    }

}

