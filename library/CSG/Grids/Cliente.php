<?php
class CSG_Grids_Cliente{
	
	protected $grid;
	protected $cache;
	
	public function __construct(){
		
		$this->grid = CSG_Plugins_DataGrid::create();		
		$this->cache = Zend_Registry::get('cache');
		
		$clientes  = new Cliente();
		$r_clientes = $clientes->getClientes();
		
		
		if (!$result = $this->cache->load('grids_cliente')) {
            $clientes  = new Cliente();
            $r_clientes = $clientes->getClientes();
            $this->cache->save($r_clientes, 'grids_cliente');
        } else{
           $r_clientes = $clientes->getClientes();
        }
		
		$i=0;
		$valores = null;
		foreach ($r_clientes as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'nome' => $val->nome,
				//'cpf_cnpj' => $val->cpf == null ? $val->cnpj : $val->cpf,
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		 $source = new Bvb_Grid_Source_Array($valores);
		 $source->setPrimaryKey(array('id'));
		 $this->grid->setSource($source);

		$this->grid->updateColumn('id',array('title'=>'ID','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/cliente/ver/id/">{{id}}</a>'));
		
		$this->grid->updateColumn('nome',array('title'=>'Nome','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/cliente/ver/id/{{id}}">{{nome}}</a>'));
		//$this->grid->updateColumn('cpf_cnpj',array('title'=>'CPF/CNPJ ','class'=>'grid'));
		
		$columns = array('nome','Ações');
		$export = array('nome','descricao');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10);  

       	
       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('nome', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('')->name('Ações')->decorator('
        		<a href="/admin/cliente/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/cliente/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/cliente/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}