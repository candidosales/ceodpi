<?php
class CSG_View_Helper_Transliterate extends Zend_View_Helper_Abstract
{
  public function transliterate($value)
  {
      $filterTransliterate = new My_Filter_Transliterate();
      return $filterAlias->filter($value);
  }
}