<?php
/**
 * (c) 2020 Francesco Terenzani
 */
namespace pp;

class Mail
{

    static function send($template, $data)
    {
        $mailer = get('config/mailer.php');
        $render = function($template, $data) {
            extract($data);
            require $template;
        };
        $message = Closure::bind($render, $mailer);
        $message($template, $data);
        return $mailer->send();
    }

}