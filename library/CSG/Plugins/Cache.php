<?php
/**
 * @version 1.0.0
 */
class CSG_Plugins_Cache {
    /**
     * @var boolean
     */
    static protected $_enabled = false;

    /**
     * @var Zend_Cache_Core
     */
    static protected $_cache;
    
    static function init($enabled, $lifetime = 60) {
        self::$_enabled = $enabled;
        if(self::$_enabled) {
            require_once 'Zend/Cache.php';

            $frontendOptions = array(
               'lifetime' => $lifetime,
               'automatic_serialization' => true, 
            );
            $backendOptions = array(
                'cache_dir' => '../tmp',  // Diret�rio para salvar os arquivos gerados pelo cache
                'file_name_prefix' => 'cache', 
                'hashed_directory_level' => 2, 
            );
            self::$_cache = Zend_Cache::factory('Core', 'File', $frontendOptions, $backendOptions);
        }
    }

    static function getInstance() {
        if(self::$_enabled == false) {
            return false;
        }
        return self::$_cache;
    }
    
    static function load($keyName) {
        if(self::$_enabled == false) {
            return false;
        }
        return self::$_cache->load($keyName);
    }
    
    static function save($keyName, $dataToStore) {
        if(self::$_enabled == false) {
            return true;
        }
        
        return self::$_cache->save($dataToStore, $keyName);
    }

    static function clean($mode = 'all', $tags = array()) {
        if(self::$_enabled == true) {
            return;
        }    
        self::$_cache->clean($mode = 'all', $tags = array());   
    }
    
	static function remove($id) {
        if(self::$_enabled == true) {
            return;
        }    
        self::$_cache->remove($id);   
    }
}

