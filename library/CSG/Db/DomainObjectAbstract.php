<?php

abstract class CSG_Db_DomainObjectAbstract {

    private $id = null;
    protected $_mapper = null;

    public function __construct(array $options = null) {
        if (is_array($options))
            $this->setOptions($options);
    }

    public function setOptions(array $options) {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods))
                $this->$method($value);
        }
        return $this;
    }

    public function setId($id) {
        if (!is_null($this->id)) {
            throw new Exception('ID nao pode ser alterado');
        }
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function getMapper() {
        $m = new $this->_mapper;
        return $m;
    }

    public function save() {
        $this->getMapper()->save($this);
        return $this->getMapper()->getLastInsertId();
    }

    public function fetchAll() {
        return $this->getMapper()->fetchAll();
    }

	public function fetchPairs($sql) {
        return $this->getMapper()->getDb()->fetchPairs($sql);
    }
    
    public function find($id) {
        return $this->getMapper()->find($id);
    }

    public function getAsArray($id) {
        return $this->getMapper()->getAsArray($id);
    }

    public function delete($id) {
        return $this->getMapper()->delete($id);
    }

    public function getLastInsertId(){
        return $this->getMapper()->getLastInsertId();
    }
}