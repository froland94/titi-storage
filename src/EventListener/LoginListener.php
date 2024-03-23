<?php

namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Security\Core\Event\AuthenticationSuccessEvent;

#[AsEventListener]
class LoginListener
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[NoReturn]
    public function __invoke(AuthenticationSuccessEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $user->setLastLoginAt();
        $this->entityManager->flush();
    }
}
