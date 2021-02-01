<?php
namespace App\Controller;

use App\Model\BlogModel;
use Src\AbstractController;

class Admin extends AbstractController
{
    public function deletemessage()
    {
        $id=$_GET['id'];
        $modelBlog= new BlogModel();
        $modelBlog->deleteMessages($id);
        $this->redirect('..\..\html\..\Blog\blog');
    }
}
