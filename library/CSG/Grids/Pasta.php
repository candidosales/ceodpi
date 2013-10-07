<?php
class CSG_Grids_Pasta{
	
	public $grid;

	public function __construct($id_gaveta = null){
		
		$this->grid = CSG_Plugins_DataGrid::create();

		$pastas  = new Pasta();
		$r_pastas = $pastas->getPastasGrid($id_gaveta);
		
		$i=0;
		$valores = null;
		foreach ($r_pastas as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'numero' => $val->numero,
				'descricao' => $val->descricao,
				'gaveta_id' => $val->gaveta_id,
				'g_nome' => $val->g_nome,
				'tipo_procedimento' => $val->tipo_procedimento,
				'tipo_procedimento_judicial' => $val->tipo_procedimento_judicial,
				'tipo_procedimento_judicial_admin' => $val->tipo_procedimento_judicial_admin
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		$source = new Bvb_Grid_Source_Array($valores);
		$source->setPrimaryKey(array('id'));
		$this->grid->setSource($source);
		
		$this->grid->updateColumn('numero',array('title'=>'Número','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/pasta/ver/id/{{id}}/">{{numero}}</a>'));
		$this->grid->updateColumn('descricao',array('title'=>'Descrição ','class'=>'grid','decorator'=> htmlentities('{{descricao}}')));
		$this->grid->updateColumn('gaveta_id',array('title'=>'Gaveta','class'=>'grid','decorator'=>'<a title="Visualizar gaveta" alt="Visualizar gaveta" href="/admin/gaveta/ver/id/{{gaveta_id}}">{{gaveta_id}} - {{g_nome}}</a>'));
		$this->grid->updateColumn('tipo_procedimento',array('title'=>'Tipo','class'=>'grid','decorator'=>'{{tipo_procedimento}} - {{tipo_procedimento_judicial}} - {{tipo_procedimento_judicial_admin}}'));
		
		$columns = array('numero','gaveta_id','tipo_procedimento','Ações');
		$export = array('numero','descricao','gaveta_id','tipo_procedimento');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10); 

       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('numero', array('render'=>'text'));
		$filters->addFilter('descricao', array('render'=>'text'));
		$filters->addFilter('gaveta_id', array('render'=>'text'));
		$filters->addFilter('tipo_procedimento', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('')->name('Ações')->decorator('
        	    		<a href="/admin/pasta/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/pasta/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/pasta/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
       
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}