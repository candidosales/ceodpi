<?php

class UsuarioMapper extends CSG_Db_DataMapperAbstract {

    protected $_dbTable = "DbTable_Usuario";
    protected $_model = "Usuario";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'nome' => $obj->getNome(),
            	'login' => $obj->getLogin(),
            	'senha' => $obj->getSenha(),
            	'regra' => $obj->getRegra(),
            	'email' => $obj->getEmail(),
            	'tel' => $obj->getTel(),
            	'ultimo_acesso' => date("Y-m-d H:i:s"),
            	'usuario_id_criacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'usuario_id_atualizacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'data_criacao' => date("Y-m-d H:i:s"),
            	'data_atualizacao' => date("Y-m-d H:i:s"),
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
            	'login' => $obj->getLogin(),
            	'senha' => $obj->getSenha(),
            	'regra' => $obj->getRegra(),
            	'email' => $obj->getEmail(),
            	'tel' => $obj->getTel(),
            	'ultimo_acesso' => $obj->getUltimo_acesso(),
            	'usuario_id_atualizacao' => Zend_Auth::getInstance()->getIdentity()->id,
            	'data_atualizacao' => date("Y-m-d H:i:s"),
            	'deletado' => $obj->getDeletado(),
            	'usuario_id_deletado' => $obj->getUsuario_id_deletado(),
            	'data_deletado' => $obj->getData_deletado(),               
                             );
                             //Zend_Debug::dump($data);die;
            $dbTable->update($data, array('id = ?' => $obj->getId()));
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}