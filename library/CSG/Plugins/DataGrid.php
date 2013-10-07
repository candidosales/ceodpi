<?php
class CSG_Plugins_DataGrid extends Zend_Controller_Plugin_Abstract {
	
	public static function create($id = '')
		{
		$view = new Zend_View();
        $view->setEncoding('UTF-8');
        $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/grid.ini', 'production');
        $grid = Bvb_Grid::factory('Table', $config, 'grid');
        $grid->setEscapeOutput(false);
        $grid->setExport(array('pdf', 'print', 'wordx', 'word','excel'));
        $grid->setView($view);
        
        return $grid;
		}

}