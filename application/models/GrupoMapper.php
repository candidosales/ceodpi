<?php
class GrupoMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_Grupo";
    protected $_model = "Grupo";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'nome' => $obj->getNome(),
            	'data_criacao' => date("Y-m-d H:i:s"),
            	'data_atualizacao' => date("Y-m-d H:i:s"),
            	'usuario_id_criacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'usuario_id_atualizacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'deletado' => 0,
            	'usuario_id_deletado' => $obj->getUsuario_id_deletado(),
            	'data_deletado' => date("Y-m-d H:i:s"),                
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
				'nome' => $obj->getNome(),
            	'data_atualizacao' => date("Y-m-d H:i:s"),
            	'usuario_id_atualizacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'deletado' => $obj->getDeletado(),
            	'usuario_id_deletado' => $obj->getUsuario_id_deletado(),
            	'data_deletado' => $obj->getData_deletado(),              
                             );
            
            $dbTable->update($data, array('id = ?' => $obj->getId()));
			
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

