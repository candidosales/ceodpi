<?php
class SMSMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_SMS";
    protected $_model = "SMS";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'mensagem' => $obj->getMensagem(),
            	'usuario_id_envio' => $obj->getUsuario_id_envio(),
            	'data_envio' => date("Y-m-d H:i:s"),            
            );
            try{
            $dbTable->insert($data);
            }catch(Exception $e){
                print_r($e);
            }
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }    

    protected function _update(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'mensagem' => $obj->getMensagem(),
            	'usuario_id_envio' => $obj->getUsuario_id_envio(),
            	'data_envio' => date("Y-m-d H:i:s"),                
                             );
            
            $dbTable->update($data, array('id = ?' => $obj->getId()));
			
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}


