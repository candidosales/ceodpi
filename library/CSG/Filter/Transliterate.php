<?php
class CSG_Filter_Transliterate implements Zend_Filter_Interface 
{
  public function filter($string)
  {
     // Lista de caracteres que devem ser substitu�dos
     $a = '������������������������������$��������@�����&amp;'
        . '��������������������Rr���,.;:\|/"^~*%# ()[]{}=!?`��' 
        . "'";
 
     // Lista que ir� substituir os caracteres acima
     $b = 'aaaaaaaceeeeiiiidnoooooouuuuybssaaaaaaaaceeeee'
        . 'iiiidnoooooouuuuyybyRrooa--------------------------' 
        . '-';
 
     // Efetua a substitui��o
     $string = strtr($string, $a, $b); 
 
     // Deixa tudo min�sculo
     $string = strtolower($string);
 
     // Evita h�fens repetidos
     $string = preg_replace('/--+/', '-', $string); 
     return $string;
  }
}