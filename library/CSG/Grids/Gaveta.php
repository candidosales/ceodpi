<?php
class CSG_Grids_Gaveta{
	
	protected $grid;

	public function __construct($id_estante = null){
		
		$this->grid = CSG_Plugins_DataGrid::create();
		
		
		$gavetas  = new Gaveta();
		$r_gavetas = $gavetas->getGavetasGrid($id_estante);
		
		$estante = new Estante();
		$r = $estante->getMapper()->getDbTable()->find(1);	
		$i=0;
		$valores = null;
		foreach ($r_gavetas as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'nome' => $val->nome,
				'descricao' => $val->descricao,
				'estante_id' => $val->estante_id,
				'e_nome' => $val->e_nome,
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		 $source = new Bvb_Grid_Source_Array($valores);
		 $source->setPrimaryKey(array('id'));
		 $this->grid->setSource($source);

		$this->grid->updateColumn('id',array('title'=>'ID','class'=>'grid','style' => 'width:30%;','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/estante/ver/id/">{{id}}</a>'));
		
		$this->grid->updateColumn('nome',array('title'=>'Nome','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar gaveta" href="/admin/gaveta/ver/id/{{id}}">{{nome}}</a>'));
		$this->grid->updateColumn('descricao',array('title'=>'Descrição ','class'=>'grid','decorator'=> htmlentities('{{descricao}}')));
		$this->grid->updateColumn('estante_id',array('title'=>'Estante','class'=>'grid','decorator'=>'<a title="Visualizar estante" alt="Visualizar estante" href="/admin/estante/ver/id/{{estante_id}}">{{estante_id}} - {{e_nome}}</a>'));
		
		$columns = array('nome','descricao','estante_id','Ações');
		$export = array('nome','descricao','estante_id');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10);      
       	
       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('nome', array('render'=>'text'));
		$filters->addFilter('descricao', array('render'=>'text'));
		$filters->addFilter('estante_id', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('')->name('Ações')->decorator('
        	<a href="/admin/gaveta/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/gaveta/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/gaveta/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
       	
       	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}