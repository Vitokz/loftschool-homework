<?php

namespace Src;

class View
{
    private $templPath = '';
    public function __construct()
    {
        $this->templPath= PROJECT_ROOT_DIR . '\app\View';
    }

    public function render( string $tpl, $data=[]) : string
   {
       extract($data);
       ob_start();
       include $this->templPath .  DIRECTORY_SEPARATOR .$tpl;
       return ob_get_clean();
   }

   public function assign(string  $name, $vlaue)
   {
       $this->data[$name]= $vlaue;
   }
}