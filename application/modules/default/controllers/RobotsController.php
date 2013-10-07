<?php

class Default_RobotsController extends Zend_Controller_Action
{

    public function indexAction() 
    {
            $this->_redirect("/robots.txt", array('code' => 301));
    }

        public function robotsAction()
        {
            $this->_helper->getHelper('layout')->disableLayout();
            $this->getResponse()
                    ->setHeader('Content-type', 'text/plain');

            $this->view->sslEnabled = false;

            if(isset($_SERVER['HTTPS']))
                $this->view->sslEnabled = true;
        }

}

