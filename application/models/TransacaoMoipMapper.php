<?php
class TransacaoMoipMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_TransacaoMoip";
    protected $_model = "TransacaoMoip";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
            	'id_transacao' => $obj->getId_transacao(),
				'cliente_nome' => $obj->getCliente_nome(),
            	'cliente_id' => $obj->getCliente_id(),
            	'status_pagamento' => $obj->getStatus_pagamento(),
            	'cod_moip' => $obj->getCod_moip(),
            	'forma_pagamento' => $obj->getForma_pagamento(),
            	'tipo_pagamento' => $obj->getTipo_pagamento(),
            	'email_consumidor' => $obj->getEmail_consumidor(),
            	'data_criacao' => date("Y-m-d H:i:s"),
            	'valor' => $obj->getValor(),               
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
            	'status_pagamento' => $obj->getStatus_pagamento(),
            	'cod_moip' => $obj->getCod_moip(),
            	'forma_pagamento' => $obj->getForma_pagamento(),
            	'tipo_pagamento' => $obj->getTipo_pagamento(),
            	'email_consumidor' => $obj->getEmail_consumidor(),
            	'valor' => $obj->getValor(),              
                             );
            
            $dbTable->update($data, array('id = ?' => $obj->getId()));
			
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

