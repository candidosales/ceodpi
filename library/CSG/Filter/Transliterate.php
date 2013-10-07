<?php
class CSG_Filter_Transliterate implements Zend_Filter_Interface 
{
  public function filter($string)
  {
     // Lista de caracteres que devem ser substituםdos
     $a = 'ְֱֲֳִֵֶַָֹÊֻּֽ־ֿ׀ׁׂ׃װױײ״ÙÚÛÜÝÞ$ßאבגדהוז@חטיךכ&amp;'
        . 'לםמןנסעףפץצרשתûü‎‎‏ÿRr°÷×,.;:\|/"^~*%# ()[]{}=!?`‘’' 
        . "'";
 
     // Lista que irב substituir os caracteres acima
     $b = 'aaaaaaaceeeeiiiidnoooooouuuuybssaaaaaaaaceeeee'
        . 'iiiidnoooooouuuuyybyRrooa--------------------------' 
        . '-';
 
     // Efetua a substituiחדo
     $string = strtr($string, $a, $b); 
 
     // Deixa tudo minתsculo
     $string = strtolower($string);
 
     // Evita hםfens repetidos
     $string = preg_replace('/--+/', '-', $string); 
     return $string;
  }
}