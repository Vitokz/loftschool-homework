<?php
namespace App\Controller;

use Src\AbstractController;

class Blog extends AbstractController
{
    public function blog()
    {
       if(empty($this->currentUser)) {
           $this->redirect('User\registration');
       }

    }

}