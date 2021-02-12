<?php
namespace App\Model;

use Intervention\Image\ImageManagerStatic as Image;
use Src\AbstractController;

class LoadFile extends AbstractController
{
    public $image;
    static protected $_imagePath;

        public function __construct()
    {
        self::$_imagePath=getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

    public function loadFile($file)
    {
        if(file_exists($file)){
            $this->image = $this->genImageName();
            $rezFile=$this->imageResize($file,$this->image);
            //move_uploaded_file( $rezFile , getcwd() . DIRECTORY_SEPARATOR . "images" . DIRECTORY_SEPARATOR . $this->image);
        }

        return $this->image;
    }

    public function genImageName()
    {
        return sha1(mt_rand(1,10000)) . '.jpg';
    }
    public function imageResize($file,$name)
    {
        $source = $file;
        $result = self::$_imagePath . $name;
        $image = Image::make($source)
            ->resize(200, null, function ($image) {
                $image->aspectRatio();
            })
            ->save($result, 80);
        return $file;
    }

}