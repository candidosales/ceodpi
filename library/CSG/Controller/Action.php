<?php

abstract class CSG_Controller_Action extends Zend_Controller_Action {

    protected $cache;
    protected $user;

    public function init() {
        $this->cache = Zend_Registry::get('cache');
        $this->user = Zend_Auth::getInstance()->setStorage(new Zend_Auth_Storage_Session("default"))->getIdentity();
    }

}