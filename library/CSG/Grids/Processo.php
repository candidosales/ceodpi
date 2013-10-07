<?php
class CSG_Grids_Processo{
	
	public $grid;

	public function __construct($id_cliente = null, $id_pasta = null){
		
		$this->grid = CSG_Plugins_DataGrid::create();

		$processos  = new Processo();
		$r_processos = $processos->getProcessosGrid($id_cliente,$id_pasta);
		
		$i=0;
		$valores = null;
		foreach ($r_processos as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'cliente_id_processo' => $val->cliente_id_processo,
				'c_nome' => $val->c_nome,
				'outra_parte' => $val->outra_parte,
				'pasta_id' => $val->pasta_id,
				'procedimento' => $val->procedimento,
				'comarca' => $val->comarca,
				'numero' => $val->numero,
				'pa_numero' => $val->pa_numero,
				'ano' => $val->ano
			);
		$i++;
		endforeach;
		//Zend_Debug::dump($valores);die;
		if($valores!=null){
		
		$source = new Bvb_Grid_Source_Array($valores);
		$source->setPrimaryKey(array('id'));
		$this->grid->setSource($source);
		
		$this->grid->updateColumn('cliente_id_processo',array('title'=>'Cliente ','class'=>'grid','decorator'=>'<a title="Visualizar cliente" alt="Visualizar pasta" href="/admin/cliente/ver/id/{{cliente_id_processo}}">{{c_nome}}</a>'));
		$this->grid->updateColumn('outra_parte',array('title'=>'Outra parte','class'=>'grid','decorator'=>'{{outra_parte}}'));
		$this->grid->updateColumn('procedimento',array('title'=>'Proc.','class'=>'grid','decorator'=>'{{procedimento}}'));
		$this->grid->updateColumn('numero',array('title'=>'N°/Comarca','class'=>'grid','decorator'=>'{{numero}}/{{comarca}}'));
		$this->grid->updateColumn('pa_numero',array('title'=>'Pasta','class'=>'grid','decorator'=>'<a title="Visualizar pasta" alt="Visualizar pasta" href="/admin/pasta/ver/id/{{pasta_id}}">{{pa_numero}}</a>'));
		$this->grid->updateColumn('ano',array('title'=>'Ano','class'=>'grid'));
		
		$columns = array('cliente_id_processo','outra_parte','numero','pa_numero','ano','Ações');
		$export = array('cliente_id_processo','outra_parte','numero','pa_numero','ano');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10); 

       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('cliente_id_processo', array('render'=>'text'));
		$filters->addFilter('outra_parte', array('render'=>'text'));
		$filters->addFilter('procedimento', array('render'=>'text'));
		$filters->addFilter('numero', array('render'=>'text'));
		$filters->addFilter('pa_numero', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('')->name('Ações')->decorator('
        	    		<a href="/admin/processo/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/processo/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/processo/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}