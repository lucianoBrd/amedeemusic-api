<?php

namespace App\Service;

class RecaptchaService
{
    public function __construct(
        
    )
    {
    }

    public function checkCaptcha($captcha) {
        $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $this->params->get('recaptcha_private_key') . '&response=' . $captcha);
        $resp = json_decode($verifyResponse);
        return $resp != null && $resp->success;
    }
}
