<?php

class Default_SitemapController extends Zend_Controller_Action
{

    public function indexAction()
	{
	  $this->_helper->layout->disableLayout();
	}
	
	public function redirectAction()
	{
	  $this->_redirect('/sitemap');
	}

}

