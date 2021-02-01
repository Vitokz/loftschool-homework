<?php
namespace App\Controller;

use App\Model\BlogModel;
use Src\AbstractController;

class Admin extends AbstractController
{
    public function deletemessage()
    {
        if($_SESSION['id']=== ADMIN_ID) {
            $id = $_GET['id'];
            $modelBlog = new BlogModel();
            $modelBlog->deleteMessages($id);
            $this->redirect(DIRECTORY_SEPARATOR .'Blog');
        }else{$this->redirect(DIRECTORY_SEPARATOR .'Blog');}
    }
}
