<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   
	protected function _initEvento(){
		$evento = new Zend_Config_Ini(APPLICATION_PATH . '/configs/evento.ini', 'production');
		Zend_Registry::set('evento', $evento);
	}
   
    protected function _initDoctype()
    {
		$config = Zend_Registry::get('evento');
		
    	date_default_timezone_set('America/Fortaleza');
        $this->bootstrap('view');
        $view = $this->getResource('view');
        $view->doctype('HTML5');
        $view->headTitle()->setSeparator(' - ')->headTitle($config->evento->title);
        $view->headMeta()->setCharset('UTF-8')
						 ->appendHttpEquiv('X-UA-Compatible','IE=edge')
						 ->appendHttpEquiv('expires','0')
						 ->appendHttpEquiv('pragma', 'no-cache')
						 ->appendHttpEquiv('Cache-Control', 'public')

						 ->appendName('keywords', 'x congresso da ordem demolay, piaui, teresina, brasil, demolay')
						 ->appendName('viewport', 'initial-scale=1.0, user-scalable=yes')
						 
						 ->appendName('description', $config->evento->description)
						 ->appendName('author', 'Vende Publicidade')
						 
						 ->appendName('google-site-verification','ODG2HFpuNQ8RkV8s7jFMP8B9V3MGPAsekrrhTXQ6z9A')
						 ->appendName('msvalidate.01', '')
						 ->appendName('robots','index,follow')
						 ->appendName('reply-to','candidosg@gmail.com')
						 ->appendName('distribution','world');
        
        $view->addHelperPath('ZendX/JQuery/View/Helper/', 'ZendX_JQuery_View_Helper')   
             ->jQuery()->setLocalPath($view->baseUrl . '/js/jquery-1.7.1.min.js')
                       ->setUiLocalPath($view->baseUrl . '/js/ui/jquery-ui-1.8.9.custom.min.js')
                       ->addStylesheet($view->baseUrl . '/css/jquery.ui.css');
        $view->addHelperPath('CSG/View/Helper/', 'CSG_View_Helper');
        
        
        $locale = new Zend_Locale('pt_BR');
		Zend_Registry::set('Zend_Locale', $locale);
        
        Zend_Registry::set('view', $view);
    }
	
	protected function _initAutoLoader() {
		$autoloader = Zend_Loader_Autoloader::getInstance();
		/*$autoloader->registerNamespace("CSG");
        $autoloader->registerNamespace("ZendX");
        $autoloader->registerNamespace("ZFDebug");
        return $autoloader;*/
        $autoloader->setFallbackAutoloader(true); // carrega tudo
    }
    
	protected function _initConfig()
	{
	    $config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/application.ini', APPLICATION_ENV);
        Zend_Registry::set('config', $config);
	}
		   
	  protected function _initDb()
    {
        $resource = $this->getPluginResource('db');
        $resource->init();
        $adapter = $resource->getDbAdapter();
        Zend_Registry::set('db', $adapter);
    }
	  protected function _initDatabase(){
		$config = Zend_Registry::get('config');
		// Database
		$db = Zend_Db::factory($config->resources->db->adapter,$config->resources->db->params->toArray());
		Zend_Db_Table::setDefaultAdapter ( $db );
		$db->getConnection()->exec("SET NAMES utf8");
		$db->setFetchMode (Zend_Db::FETCH_OBJ);
		$db->setProfiler(true);
		Zend_Registry::set ('db',$db);
	}
	
	protected function _initPlugins() {
        $bootstrap = $this->getApplication();
        if ($bootstrap instanceof Zend_Application) {
            $bootstrap = $this;
        }
        $bootstrap->bootstrap('FrontController');
        $front = $bootstrap->getResource('FrontController');

        $front->registerPlugin(new CSG_Plugins_Layout());
        $front->registerPlugin(new CSG_Plugins_PagSeguro());
    }
    
	protected function _initMessenger()
	{
	 	Zend_Controller_Action_HelperBroker::addHelper(new CSG_Controller_Action_Helper_Messenger());
	}
	
	protected function _initRewrite() {
		$front = Zend_Controller_Front::getInstance();
		$router = $front->getRouter();
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/routes.ini', 'production');
		$router->addConfig($config,'routes');		
	} 

    /*protected function _initZFDebug()
    {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('ZFDebug');

        $config = Zend_Registry::get('config');
        $db = Zend_Db::factory($config->resources->db->adapter,$config->resources->db->params->toArray());

        $options = array(
            'plugins' => array('Variables', 
                               'Database' => array('adapter' => $db), 
                               'File' => array('basePath' => '/path/to/project'),
                               'Exception')
        );
        $debug = new ZFDebug_Controller_Plugin_Debug($options);

        $this->bootstrap('frontController');
        $frontController = $this->getResource('frontController');
        $frontController->registerPlugin($debug);
    }*/
    
	/**
	 * Cache
	 * 
	 * **/
	/*protected function _initCache() {
        $front = array('lifetime' => 7200, 'automatic_serialization' => true);
        $back = array('cache_dir' => '../tmp');       
        $cache = Zend_Cache::factory('Core', 'File', $front, $back);
       
        Zend_Db_Table_Abstract::setDefaultMetadataCache($cache);
        Zend_Locale::setCache($cache);
        Zend_Currency::setCache($cache);
        Zend_Translate::setCache($cache);
        Zend_Paginator::setCache($cache);
        Zend_Feed_Reader::setCache($cache);
       
        Zend_Registry::set('cache', $cache);
    }*/
	
	/*protected function _initCache() {

        $frontendCore = array('lifetime' => 60, 'automatic_serialization' => true);

        $frontendOptions = array(
            'lifetime' => 60,
            'debug_header' => true,
            'default_options' => array(
                'cache_with_get_variables' => false,
                'make_id_with_get_variables' => false,
                'cache_with_post_variables' => false,
                'make_id_with_post_variables' => false,
                'cache_with_session_variables' => true,
                'make_id_with_session_variables' => true,
                'cache_with_files_variables' => false,
                'make_id_with_files_variables' => false,
                'cache_with_cookie_variables' => true,
                'make_id_with_cookie_variables' => false, // se false a pagina sera igual para todos
                'cache' => false),
            'regexps' => array(
                '^/pages/' => array('cache' => true),
                ));

        $backendOptions = array('cache_dir' => APPLICATION_PATH . '/../cache/');

        $backMemcached = array('host' => 'localhost'
            , 'port' => 11211
            , 'persistent' => true);

        $PageCache = Zend_Cache::factory('Page', 'File', $frontendOptions, $backendOptions);
        $CoreCache = Zend_Cache::factory('Core', 'Apc', $frontendCore, $backendOptions);
        Zend_Db_Table_Abstract::setDefaultMetadataCache($CoreCache);
        Zend_Registry::set('cache', $CoreCache);
        $PageCache->start();
    }*/
    
}