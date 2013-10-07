<?php
class ClienteMapper extends CSG_Db_DataMapperAbstract{

    protected $_dbTable = "DbTable_Cliente";
    protected $_model = "Cliente";

    protected function _insert(CSG_Db_DomainObjectAbstract $obj) {
        try {
            $dbTable = $this->getDbTable();
            $data = array(
				'nome' =>  mb_strtoupper($obj->getNome(),'UTF-8'),
            	'endereco' => mb_strtoupper($obj->getEndereco(),'UTF-8'),
            	'cidade' => mb_strtoupper($obj->getCidade(),'UTF-8'),
            	'estado' => mb_strtoupper($obj->getEstado(),'UTF-8'),
            	'pais' => mb_strtoupper($obj->getPais(),'UTF-8'),
            	'cep' => $obj->getCep(),
            	'cpf' => $obj->getCpf(),
            	'rg' => $obj->getRg(),
            	'email' => mb_strtolower($obj->getEmail()),
            	'tipo' => $obj->getTipo(),
            	'tipo_participacao' => 'inscrito',
            	'filiado' => $obj->getFiliado(),
            	'instituicao' => mb_strtoupper($obj->getInstituicao(),'UTF-8'),
            	'empresa' => mb_strtoupper($obj->getEmpresa(),'UTF-8'),
            	'twitter' => mb_strtolower($obj->getTwitter()),
            	'celular' => $obj->getCelular(),
            	'hospedagem' => $obj->getHospedagem(),
            	'data_nasc' =>  implode("-", array_reverse(explode("/", $obj->getData_nasc()))),
            	'data_inscricao' => date("Y-m-d H:i:s"),
            	'confirma_pagamento' => 0,
            	'data_confirma_pagamento' => null,
                'grupo_id' => $obj->getGrupo_id(),
            	'grupo_nome' => $obj->getGrupo_nome(), 
            	'deletado' => 0,
            	'usuario_id_deletado' => 0,
            	'data_deletado' => date("Y-m-d H:i:s"),      
            );
            try{
            	//Zend_Debug::dump($data);die;
           		$dbTable->insert($data);
            }catch(Exception $e){
                print_r($e); //die;
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
            	'endereco' => mb_strtoupper($obj->getEndereco(),'UTF-8'),
            	'cidade' => mb_strtoupper($obj->getCidade(),'UTF-8'),
            	'estado' => mb_strtoupper($obj->getEstado(),'UTF-8'),
            	'pais' => mb_strtoupper($obj->getPais(),'UTF-8'),
            	'cep' => $obj->getCep(),
            	'cpf' => $obj->getCpf(),
            	'rg' => $obj->getRg(),
            	'email' => mb_strtolower($obj->getEmail()),
            	'tipo' => $obj->getTipo(),
            	'tipo_participacao' => $obj->getTipo_participacao(),
            	'filiado' => $obj->getFiliado(),
            	'instituicao' => mb_strtoupper($obj->getInstituicao(),'UTF-8'),
            	'empresa' => mb_strtoupper($obj->getEmpresa(),'UTF-8'),
            	'twitter' => mb_strtolower($obj->getTwitter()),
            	'hospedagem' => $obj->getHospedagem(),
            	'celular' => $obj->getCelular(),
            	'data_nasc' => $obj->getData_nasc(),
            	'data_inscricao' => $obj->getData_inscricao(),
            	'confirma_pagamento' => $obj->getConfirma_pagamento(),
            	'data_confirma_pagamento' => $obj->getData_confirma_pagamento(),
                'grupo_id' => $obj->getGrupo_id(),
            	'grupo_nome' => $obj->getGrupo_nome(),
            	'deletado' => $obj->getDeletado(),
            	'usuario_id_deletado' => $obj->getUsuario_id_deletado(),
            	'data_deletado' => $obj->getData_deletado(),                
                             );
                             
                             //Zend_Debug::dump($data);
                             
            $dbTable->update($data, array('id = ?' => $obj->getId()));
            return true;
        } catch (Zend_Exception $e) {
            return false;
        }
    }

}

