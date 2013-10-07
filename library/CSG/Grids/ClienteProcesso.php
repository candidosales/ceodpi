<?php
class CSG_Grids_ClienteProcesso{
	
	public $grid;

	public function __construct($cliente_id){
		
		$this->grid = CSG_Plugins_DataGrid::create();

		$processos  = new Processo();
		$r_processos = $processos->getProcessosDoCliente($cliente_id);
		
		$i=0;
		$valores = null;
		foreach ($r_processos as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'cliente' => $val->cliente,
				'outra_parte' => $val->outra_parte,
				'pasta_id' => $val->pasta_id,
				'procedimento' => $val->procedimento,
				'comarca' => $val->comarca,
				'numero' => $val->numero,
				'pa_numero' => $val->pa_numero
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		$source = new Bvb_Grid_Source_Array($valores);
		$source->setPrimaryKey(array('id'));
		$this->grid->setSource($source);
		
		$this->grid->updateColumn('cliente',array('title'=>'Cliente ','class'=>'grid','style' => 'width:15%;'));
		$this->grid->updateColumn('outra_parte',array('title'=>'Outra parte','class'=>'grid','style' => 'width:15%;','decorator'=>'{{outra_parte}}'));
		$this->grid->updateColumn('procedimento',array('title'=>'Procedimento','class'=>'grid','style' => 'width:15%;','decorator'=>'{{procedimento}}'));
		$this->grid->updateColumn('numero',array('title'=>'Número/Comarca','class'=>'grid','style' => 'width:20%;','decorator'=>'{{numero}}/{{comarca}}'));
		$this->grid->updateColumn('pa_numero',array('title'=>'Pasta','class'=>'grid','style' => 'width:20%;','decorator'=>'<a title="Visualizar pasta" alt="Visualizar pasta" href="/pasta/ver/id/{{pasta_id}}">{{pa_numero}}</a>'));
		
		$columns = array('cliente','outra_parte','procedimento','numero','pa_numero','Ações');
		$export = array('cliente','outra_parte','procedimento','numero','pa_numero');
		
       	$this->grid->setPdfGridColumns($export);
       	$this->grid->setWordGridColumns($export);
       	$this->grid->setExcelGridColumns($export);
       	$this->grid->setPrintGridColumns($export);
       	
       	$this->grid->setTableGridColumns($columns);

       	$this->grid->setRecordsPerPage(10); 

       	$filters = new Bvb_Grid_Filters();
		$filters->addFilter('cliente', array('render'=>'text'));
		$filters->addFilter('outra_parte', array('render'=>'text'));
		$filters->addFilter('procedimento', array('render'=>'text'));
		$filters->addFilter('numero', array('render'=>'text'));
		$filters->addFilter('pa_numero', array('render'=>'text'));
		$this->grid->addFilters($filters);
       	
       	$action = new Bvb_Grid_Extra_Column();
        $action->position('right')->class('width_20')->name('Ações')->decorator('
        	<ul class="action">
        		<li><a id="button_tipsy" class="display" title="Visualizar" alt="Visualizar" href="/processo/ver/id/{{id}}/">Visualizar</a></li>		       		
        		<li><a id="button_tipsy" class="edit" title="Editar" alt="Editar" href="/processo/editar/id/{{id}}/">Editar</a></li>
        		<li><a id="button_tipsy" onClick="confirma({{id}})" class="delete" title="Deletar" alt="Deletar" href="#">Deletar</a></li>
        	</ul>');
	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}