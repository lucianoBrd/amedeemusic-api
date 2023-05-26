<?php

namespace App\Service;

use App\Entity\Locals;
use App\Entity\Language;

class LocalGenerator
{
    private $locals = Locals::LOCALS;

    public function __construct()
    {
    }

    public function getLocals(): array {
        return $this->locals;
    }

    public function checkLocal(?string $local): string {
        foreach ($this->locals as $l) {
            if ($l == $local) {
                return $l;
            }
        }
        return Locals::EN;
    }

    public function getLanguageByLocal(string $local): Language {
        $language = new Language();
        if ($local == Locals::FR) {
            $language
                ->setUnsubscribe('Se désabonner')
                ->setSubscribe('S\'abonner')
                ->setUnsubscribeSuccess('Désabonnement effectué avec succès')
                ->setHello('Bonjour')
                ->setAnyQuestionsContactMe('Si vous avez des questions, n\'hésitez pas à me contacter')
                ->setHaveAQuestion('Vous avez une question ?')
                ->setConfirmationOfRecusal('Confirmation de Réception')
                ->setWillAnswerYou('Je vous répondrais dans les meilleurs délais.')
                ->setThankSubscribe('Merci de vous être abonné')
                ->setThankMessage('Merci pour votre message, je vous répondrais dans les meilleurs délais.')
                ->setMessage('Votre message :')
                ->setWebsite('Accéder au site Web')
                ->setUnsubscribeError('Impossible d\'effectuer le désabonnement')
                ->setErrorHelp('Si le problème persiste, n\'hésitez pas à me contacter.')
                ->setErrorHelp('Si le problème persiste, n\'hésitez pas à me contacter.')
                ->setSubscribeError('Impossible d\'effectuer l\'abonnement')
                ->setUnsubscribeText('Vous recevez ce courriel parce que vous êtes abonné à la Newsletter d\'Amédée')
                ->setBy('par')
                ->setRespond('Répondre')
                ->setMessageFrom('Message de')
            ;
        } else {
            $language
                ->setUnsubscribe('Unsubscribe')
                ->setSubscribe('Subscribe')
                ->setUnsubscribeSuccess('Unsubscribe successfully')
                ->setHello('Hello')
                ->setAnyQuestionsContactMe('If you have any questions, please contact me')
                ->setHaveAQuestion('Have A question ?')
                ->setConfirmationOfRecusal('Confirmation of Recusal')
                ->setWillAnswerYou('I will answer you as soon as possible.')
                ->setThankSubscribe('Thank you for subscribing')
                ->setThankMessage('Thank you for your message, I will answer you as soon as possible.')
                ->setMessage('Your message :')
                ->setWebsite('Access the website')
                ->setUnsubscribeError('Unable to unsubscribe')
                ->setErrorHelp('If the problem persists, please contact me.')
                ->setSubscribeError('Unable to subscribe')
                ->setUnsubscribeText('You\'re receiving this email because you are subscribed to The Newsletter from Amédée')
                ->setBy('by')
                ->setRespond('Respond')
                ->setMessageFrom('Message from')
            ;
        }
        return $language;
    }
}
