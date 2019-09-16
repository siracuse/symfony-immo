<?php
namespace BienBundle\Listener;

use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegistrationConfirmListener implements EventSubscriberInterface
{
    private $router;

    public function getParent()
    {
        return 'FOSUserBundle';
    }

    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_CONFIRM => 'onRegistrationConfirm'
        );
    }

    public function onRegistrationConfirm(GetResponseUserEvent $event, Request $request)
    {
        $url = $this->router->generate('admin-accueil');

        $event->setResponse(new RedirectResponse($url));

        $redirection = new RedirectResponse($this->router->generate('accueil'));
        return $redirection;
    }
}