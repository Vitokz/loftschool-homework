<?php
namespace App\Controller;

use Src\AbstractController;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Emailpush extends AbstractController
{
    private $twig;
    public function __construct()
    {
        $loader = new FilesystemLoader(PROJECT_ROOT_DIR . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'View');
        $this->twig = new Environment($loader, ['debug' => true]);
    }
    public function emailpush()
    {
        try {
            $transport = new Swift_SmtpTransport(HOST_SMPT, PORT, ENCRYPTION);
            $transport->setUsername(EMAIL);
            $transport->setPassword(PASSWORD);

            $mailer = new Swift_Mailer($transport);
            $info=file_get_contents(PROJECT_ROOT_DIR.'\app\View\EmailLetter\emailLetter.twig');
            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom([EMAIL => 'Прилетела Проверочка'])
                ->setTo(['vitalik-kaziev@mail.ru'])
                ->setBody($info)
            ;

            $result = $mailer->send($message);
            var_dump($result);
        }catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}