<?php

namespace RoyalAcademyBundle\Controller;


use RoyalAcademyBundle\Entity\Rolusuario;
use Acme\Store\Event\OrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Doctrine\ORM\EntityManagerInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use Symfony\Component\Security\Core\Security;

class RegistrarController implements EventSubscriberInterface
{
	private $router;
	private $em;
    private $userManager;
    private $securityContext;

    public function __construct(UrlGeneratorInterface $router,UserManagerInterface $userManager,EntityManagerInterface $em, Security $security )
    {
        $this->router = $router;
        $this->em = $em;
        $this->userManager = $userManager;
        $this->securityContext = $security;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_SUCCESS => 'addRole',
            FOSUserEvents::REGISTRATION_INITIALIZE => 'redireccionIfLogged',
        );
    }

    public function addRole(FormEvent $event)
    {
        $user = $event->getForm()->getData();
        
        $repository = $this->em->getRepository(Rolusuario::class);
        $rolObj = $repository->findOneBy([
            'idrolusuario' => 5,
        ]);

        $rol = $rolObj->getRol();

        
        // Add the role that you want !
        $user->addRole($rol);
        // Update user roles
        //$this->userManager->updateUser($user); 
        $url = $this->router->generate('alumno_new', array( 'email' => $user->getEmail()));
        $response = new RedirectResponse($url);
        $event->setResponse($response);
        
    }

    public function redireccionIfLogged (GetResponseUserEvent $event){
        
        if (!$this->securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return;
        }
        if($this->securityContext->isGranted('ROLE_ALUMNO')){
            $url = $this->router->generate('alumno_index');
        }
        else if($this->securityContext->isGranted('ROLE_SINCONF')){
            $url = $this->router->generate('alumno_new');
        }
        else {
            $url = $this->router->generate('admin_index');
        }

        $response = new RedirectResponse($url);

        $event->setResponse($response);
    }
    
}