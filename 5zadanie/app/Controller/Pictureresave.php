<?php
namespace App\Controller;

use Intervention\Image\ImageManagerStatic as Image;
use Src\AbstractController;

class Pictureresave extends AbstractController
{
    protected static $_imagePath;
    public function __construct()
    {
        self::$_imagePath=getcwd() . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR;
    }

    public function pictureresave()
    {

        $source = self::$_imagePath . 'exp.jpg';
        $result = self::$_imagePath . 'exp_new.jpg';
        $image = Image::make($source)
            ->resize(200, null, function ($image) {
                $image->aspectRatio();
            })
            ->save($result, 80);

        //$image->save($result, 80);
        //echo 'success';

        self::watermark($image);

        echo $image->response('png');
    }

    public static function watermark(\Intervention\Image\Image $image)
    {
        $image->text(
            "Авторское творение",
            5,
            15,
            function ($font) {
                $font->file(self::$_imagePath . 'arial.ttf')->size('12'); //требуется расширение freetype
                $font->color(array(0, 255, 0, 0.5));
                $font->align('left');
                $font->valign('top');
            });
    }
}