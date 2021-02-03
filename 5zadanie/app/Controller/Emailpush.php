<?php
namespace App\Controller;

use Src\AbstractController;
use Swift_Mailer;
use Swift_Message;
use Swift_SmtpTransport;

class Emailpush extends AbstractController
{
    public function emailpush()
    {
        try {
            $transport = new Swift_SmtpTransport('smtp.mail.ru', 465, 'ssl');
            $transport->setUsername('proverka.loftskul@mail.ru');
            $transport->setPassword('qazpilot123');

            $mailer = new Swift_Mailer($transport);

            $message = (new Swift_Message('Wonderful Subject'))
                ->setFrom(['proverka.loftskul@mail.ru' => 'Прилетела Проверочка'])
                ->setTo(['vitalik-kaziev@mail.ru'])
                ->setBody('Це проверка ')
            ;

            $result = $mailer->send($message);
            var_dump($result);
        }catch (\Exception $e) {
            var_dump($e->getMessage());
        }
    }
}