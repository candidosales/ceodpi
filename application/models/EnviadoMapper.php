<?php
class EnviadoMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_Enviado";
    protected $_model = "Enviado";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'sms_id' => $obj->getSms_id(),
            	'usuario_id_destinatario' => $obj->getUsuario_id_destinatario(),
            	'status' => $obj->getStatus(),             
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
				'sms_id' => $obj->getSms_id(),
            	'usuario_id_destinatario' => $obj->getUsuario_id_destinatario(),
            	'status' => $obj->getStatus(),              
                             );
            
            $dbTable->update($data, array('id = ?' => $obj->getId()));
			
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

