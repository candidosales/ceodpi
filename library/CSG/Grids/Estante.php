<?php
class CSG_Grids_Estante{
	
	protected $grid;

	public function __construct(){
		
		$this->grid = CSG_Plugins_DataGrid::create();
		
		
		$estantes  = new Estante();
		$r_estantes = $estantes->getEstantes();
		//Zend_Debug::dump($estantes->getEstantes());
		
		$i=0;
		$valores = null;
		foreach ($r_estantes as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'nome' => $val->nome,
				'descricao' => $val->descricao
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		 $source = new Bvb_Grid_Source_Array($valores);
		 $source->setPrimaryKey(array('id'));
		 $this->grid->setSource($source);

		$this->grid->updateColumn('id',array('title'=>'ID','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/estante/ver/id/">{{id}}</a>'));
		
		$this->grid->updateColumn('nome',array('title'=>'Nome','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/estante/ver/id/{{id}}">{{nome}}</a>'));
		$this->grid->updateColumn('descricao',array('title'=>'Descrição ','class'=>'grid','decorator'=> htmlentities('{{descricao}}')));
		
		$columns = array('nome','descricao','Ações');
		$export = array('nome','descricao');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10);  

       	
       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('nome', array('render'=>'text'));
		$filters->addFilter('descricao', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('')->name('Ações')->decorator('
        	<a href="/admin/estante/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/estante/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/estante/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}