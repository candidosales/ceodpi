<?php
class CSG_View_Helper_Link extends Zend_View_Helper_FormElement 
{ 
    public function link($name, $value = null, $attribs = null) 
    { 
        
        //Zend_Debug::dump($attribs);die;
        $info = $this->_getInfo($name, $value, $attribs); 
        extract($info); // name, value, attribs, options, listsep, disable 
         
        $xhtml = '<a' 
               . ' id="' . $this->view->escape($id) . '"' 
               . ' class="'.$attribs["class"].'"'
               . ' href="'.$attribs["href"].'"'
               . ' title="'.$attribs["title"].'"'
               . '>'
               .'<span class="'.$attribs["span"].'">' 
               . $attribs["text"] 
               . '</span></a>'; 
         
        return $xhtml; 
    } 
} 