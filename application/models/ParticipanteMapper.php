<?php
class ParticipanteMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_Participante";
    protected $_model = "Participante";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'nome' =>  mb_strtoupper($obj->getNome(),'UTF-8'),
            	'cpf' => $obj->getCpf(),
            	'email' => mb_strtolower($obj->getEmail()),
            	'data_participacao' => date("Y-m-d H:i:s"),
            		'value1' => mb_strtoupper($obj->getValue1(),'UTF-8'),
            		'value2' => mb_strtoupper($obj->getValue2(),'UTF-8'),
            		'value3' => mb_strtoupper($obj->getValue3(),'UTF-8'),
            		'value4' => mb_strtoupper($obj->getValue4(),'UTF-8'),
            		'value5' => mb_strtoupper($obj->getValue5(),'UTF-8'),
            		'value6' => mb_strtoupper($obj->getValue6(),'UTF-8'),
            		'value7' => mb_strtoupper($obj->getValue7(),'UTF-8'),
            		'value8' => mb_strtoupper($obj->getValue8(),'UTF-8'),
            		'value9' => mb_strtoupper($obj->getValue9(),'UTF-8'),
            		'value10' => mb_strtoupper($obj->getValue10(),'UTF-8'),
            		'value11' => mb_strtoupper($obj->getValue11(),'UTF-8'),
            		'value12' => mb_strtoupper($obj->getValue12(),'UTF-8'),
            		'value13' => mb_strtoupper($obj->getValue13(),'UTF-8'),
            		'value14' => mb_strtoupper($obj->getValue14(),'UTF-8'),
            		'value15' => mb_strtoupper($obj->getValue15(),'UTF-8'),
            		'value16' => mb_strtoupper($obj->getValue16(),'UTF-8'),
            		'value17' => mb_strtoupper($obj->getValue17(),'UTF-8'),
            		'value18' => mb_strtoupper($obj->getValue18(),'UTF-8'),
            		'value19' => mb_strtoupper($obj->getValue19(),'UTF-8'),
            		'value20' => mb_strtoupper($obj->getValue20(),'UTF-8'),
            		'value21' => mb_strtoupper($obj->getValue21(),'UTF-8'),
            		'value22' => mb_strtoupper($obj->getValue22(),'UTF-8'),
            		'value23' => mb_strtoupper($obj->getValue23(),'UTF-8'),
            		'value24' => mb_strtoupper($obj->getValue24(),'UTF-8'),
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
				'nome' => mb_strtoupper($obj->getNome(),'UTF-8'),
            	'cpf' => $obj->getCpf(),
            	'email' => mb_strtolower($obj->getEmail()),
            	'data_participacao' => date("Y-m-d H:i:s"),
            		'value1' => mb_strtoupper($obj->getValue1(),'UTF-8'),
            		'value2' => mb_strtoupper($obj->getValue2(),'UTF-8'),
            		'value3' => mb_strtoupper($obj->getValue3(),'UTF-8'),
            		'value4' => mb_strtoupper($obj->getValue4(),'UTF-8'),
            		'value5' => mb_strtoupper($obj->getValue5(),'UTF-8'),
            		'value6' => mb_strtoupper($obj->getValue6(),'UTF-8'),
            		'value7' => mb_strtoupper($obj->getValue7(),'UTF-8'),
            		'value8' => mb_strtoupper($obj->getValue8(),'UTF-8'),
            		'value9' => mb_strtoupper($obj->getValue9(),'UTF-8'),
            		'value10' => mb_strtoupper($obj->getValue10(),'UTF-8'),
            		'value11' => mb_strtoupper($obj->getValue11(),'UTF-8'),
            		'value12' => mb_strtoupper($obj->getValue12(),'UTF-8'),
            		'value13' => mb_strtoupper($obj->getValue13(),'UTF-8'),
            		'value14' => mb_strtoupper($obj->getValue14(),'UTF-8'),
            		'value15' => mb_strtoupper($obj->getValue15(),'UTF-8'),
            		'value16' => mb_strtoupper($obj->getValue16(),'UTF-8'),
            		'value17' => mb_strtoupper($obj->getValue17(),'UTF-8'),
            		'value18' => mb_strtoupper($obj->getValue18(),'UTF-8'),
            		'value19' => mb_strtoupper($obj->getValue19(),'UTF-8'),
            		'value20' => mb_strtoupper($obj->getValue20(),'UTF-8'),
            		'value21' => mb_strtoupper($obj->getValue21(),'UTF-8'),
            		'value22' => mb_strtoupper($obj->getValue22(),'UTF-8'),
            		'value23' => mb_strtoupper($obj->getValue23(),'UTF-8'),
            		'value24' => mb_strtoupper($obj->getValue24(),'UTF-8'),
                             );
                             
                             //Zend_Debug::dump($data);
                             
            $dbTable->update($data, array('id = ?' => $obj->getId()));
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

