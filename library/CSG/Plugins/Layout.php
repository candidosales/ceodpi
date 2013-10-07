<?php
class CSG_Plugins_Layout extends Zend_Controller_Plugin_Abstract{
	
	public function dispatchLoopStartup(Zend_Controller_Request_Abstract $request){
			Zend_Registry::set('module',$request->getModuleName());
        	Zend_Registry::set('controller',$request->getControllerName());
			
			$layout = Zend_Layout::getMvcInstance();
			if($request->isXmlHttpRequest()){
			   $layout->disableLayout();
			}else{
				$layout->setLayout("layout")->setLayoutPath(APPLICATION_PATH . '/modules/' . $request->getModuleName() . '/views/layouts');
			}
	}
}
