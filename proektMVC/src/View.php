<?php

namespace Src;

class View
{
    private $data = [];
    private $templPath = '';

    public function __construct()
    {
        $this->templPath = PROJECT_ROOT_DIR . '\app\View';
    }

    public function render(string $tpl, $data = []): string
    {
       $this->data += $data;
       ob_start();
       include $this->templPath . DIRECTORY_SEPARATOR . $tpl;
       return ob_get_clean();
   }
   public function __get($varName)
   {
       return $this->data[$varName] ?? null;
   }


}