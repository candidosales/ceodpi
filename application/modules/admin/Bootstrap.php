<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap{
	
	private $_acl = null;
	   
    public function _initAdminAcl() {
    	//Se não for autenticado
        if (Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session("admin"))->hasIdentity()) {
            Zend_Registry::set('regra', Zend_Auth::getInstance()
                                    ->setStorage(new Zend_Auth_Storage_Session("admin"))
                                    ->getStorage()->read()->regra);
        }else{
        	//Será visitante
            Zend_Registry::set('regra', 'visitante');
        }

        $this->_acl = new CSG_Plugins_AdminAcl();
        Zend_Registry::set('acl', $this->_acl);

        $front = Zend_Controller_Front::getInstance();
        $front->registerPlugin(new CSG_Plugins_CheckAcl($this->_acl));
    }
}