<?php

namespace App\Service;

use App\Entity\Mail;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

class UserService
{

    public function __construct(
        private EntityManagerInterface $manager,
        private ContainerBagInterface $params,
    )
    {
    }

    public function getAllSubscribeUser(): array
    {
        $repository = $this->manager->getRepository(User::class);

        return $repository->findBy(['subscribe' => true], ['id' => 'ASC']);
    }

    public function getUserName(User $user): string
    {
        return ($user->getName() ? $user->getName() : $user->getMail());
    }

    public function getUserReturn(?User $user): User
    {
        $userReturn = new User();

        if (!$user) {
            $userReturn->setId(-1);
        } else {
            $userReturn
                ->setId($user->getId())
                ->setName($user->getName())
                ->setMail($user->getMail())
                ->setSubscribe($user->isSubscribe())
            ;
        }
        return $userReturn;
    }

    public function addUser(User $user, $subscribe = false): User
    {
        $repository = $this->manager->getRepository(User::class);

        /* Check if user exist */
        $u = $repository->findOneBy(['mail' => $user->getMail()]);

        if ($u) {        
            if ($user->getName() != null) {
                $u->setName($user->getName());
            }

            if ($subscribe) {
                $u->setSubscribe($subscribe);
            }
            $messages = $user->getMessages();
            foreach ($messages as $message) {
                $this->manager->persist($message);
                $u->addMessage($message);
            }

            $this->manager->persist($u);
            $user = $u;

        } else {
            $messages = $user->getMessages();
            foreach ($messages as $message) {
                $this->manager->persist($message);
            }
            $user->setSecret(md5(md5(time() . $this->params->get('secret_salt')) . $user->getMail() . time()));
            $this->manager->persist($user);
        }

        $this->manager->flush();

        return $user;

    }
}
