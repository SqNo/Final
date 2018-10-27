<?php

namespace App\EventListener;

use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;


class LoginListener
{
    private $router;
    private $authChecker;

    public function __construct(RouterInterface $router, AuthorizationCheckerInterface $authChecker)
    {
        $this->router = $router;
        $this->authChecker = $authChecker;
    }

    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $url = false;

        if ($this->authChecker->isGranted('ROLE_ADMIN')) {
            $url = $this->router->generate('admin_index');
        } else if ($this->authChecker->isGranted('ROLE_SIEGE')) {
            $url = $this->router->generate('siege_index');
        } else if ($this->authChecker->isGranted('ROLE_MANAGER')) {
            $url = $this->router->generate('manager_index');
        } else if ($this->authChecker->isGranted('ROLE_COWORKER')) {
            $url = $this->router->generate('manager_index');
        }

        if ($url) return $event->getRequest()->request->set('_target_path', $url);

        return false;
    }
}

?>