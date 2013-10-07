<?php
class CSG_Grids_Usuario{
	
	protected $grid;

	public function __construct(){
		
		$this->grid = CSG_Plugins_DataGrid::create();		
		
		$usuarios  = new Usuario();
		$r_usuarios = $usuarios->getUsuarios();
		
		$i=0;
		$valores = null;
		foreach ($r_usuarios as $val):
			$valores[$i] = array(
				'id' => $val->id,
				'nome' => $val->nome,
				'login' => $val->login,
				'senha' => $val->senha,
				'regra' => $val->regra,
				'email' => $val->email,
				'tel' => $val->tel,
				'ultimo_acesso' => $val->ultimo_acesso,
				'data_criacao' => $val->data_criacao,
			);
		$i++;
		endforeach;
		
		if($valores!=null){
		
		 $source = new Bvb_Grid_Source_Array($valores);
		 $source->setPrimaryKey(array('id'));
		 $this->grid->setSource($source);

		$this->grid->updateColumn('id',array('title'=>'ID','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/cliente/ver/id/">{{id}}</a>'));
		
		$this->grid->updateColumn('nome',array('title'=>'Nome','class'=>'grid','decorator'=>'<a title="Visualizar" alt="Visualizar" href="/admin/usuario/ver/id/{{id}}">{{nome}}</a>'));
		$this->grid->updateColumn('login',array('title'=>'Login ','class'=>'grid'));
		$this->grid->updateColumn('regra',array('title'=>'Função ','class'=>'grid'));
		$this->grid->updateColumn('email',array('title'=>'E-mail ','class'=>'grid'));
		$this->grid->updateColumn('tel',array('title'=>'Telefone ','class'=>'grid'));
		
		$columns = array('nome','login','regra','email','tel','Ações');
		$export = array('nome','login','regra','email','tel');
		
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
        	    		<a href="/admin/usuario/ver/id/{{id}}/"><img src="/img/icon/eye.ico" alt="Visualizar" /></a>
        	<a href="/admin/usuario/editar/id/{{id}}/"><img src="/img/icon/pencil.png" alt="Editar" /></a>
			<a href="/admin/usuario/deletar/id/{{id}}/" class="confirmation"><img src="/img/icon/cross.png" alt="Deletar" /></a>');
	
	
        $this->grid->addExtraColumns($action);

		}else{
			$this->grid = null;
		}
	}
	
	public function getGrid(){
		return $this->grid;
	}
}