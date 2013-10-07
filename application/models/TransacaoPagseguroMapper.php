<?php
class TransacaoPagseguroMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_TransacaoPagseguro";
    protected $_model = "TransacaoPagseguro";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
            	'id_transacao' => $obj->getId_transacao(),
				'cliente_nome' => $obj->getCliente_nome(),
            	'cliente_id' => $obj->getCliente_id(),
            	'status' => $obj->getStatus(),
            	'sender_email' => $obj->getSender_email(),
            	'data_criacao' => date("Y-m-d H:i:s"),
            	'valor' => $obj->getValor(),
            	'code' => $obj->getCode(),
            	'reference' => $obj->getReference(),
            	'payment_method_type' => $obj->getPayment_method_type(),
            	'payment_method_code' => $obj->getPayment_method_code(),
            	'last_event_date' => $obj->getLast_event_date(),
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
            	'id_transacao' => $obj->getId_transacao(),
				'cliente_nome' => $obj->getCliente_nome(),
            	'cliente_id' => $obj->getCliente_id(),
            	'status' => $obj->getStatus(),
            	'sender_email' => $obj->getSender_email(),
            	'data_criacao' => date("Y-m-d H:i:s"),
            	'valor' => $obj->getValor(),
            	'code' => $obj->getCode(),
            	'reference' => $obj->getReference(),
            	'payment_method_type' => $obj->getPayment_method_type(),
            	'payment_method_code' => $obj->getPayment_method_code(),
            	'last_event_date' => $obj->getLast_event_date(),              
                             );
            
            $dbTable->update($data, array('id = ?' => $obj->getId()));
			
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

