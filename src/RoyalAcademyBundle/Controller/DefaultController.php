<?php

namespace RoyalAcademyBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Security\Core\Security;
use FOS\UserBundle\Controller\SecurityController as FOSController;

class DefaultController extends FOSController
{
	/**
     * @Route("/", name="index")
     */
	public function indexAction(\Symfony\Component\HttpFoundation\Request $request){
    	$response = parent::loginAction($request);
    
	    /** @var $session Session */
	    $session = $request->getSession();

	    $authErrorKey = Security::AUTHENTICATION_ERROR;
	    $lastUsernameKey = Security::LAST_USERNAME;
	    // get the error if any (works with forward and redirect -- see below)
	    if ($request->attributes->has($authErrorKey)) {
	        $error = $request->attributes->get($authErrorKey);
	    } elseif (null !== $session && $session->has($authErrorKey)) {
	        $error = $session->get($authErrorKey);
	        $session->remove($authErrorKey);
	    } else {
	        $error = null;
	    }

	    if (!$error instanceof AuthenticationException) {
	        $error = null; // The value does not come from the security component.
	    }
	    // last username entered by the user
	    $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

	    $csrfToken = $this->container->has('form.csrf_provider')
	        ? $this->container->get('form.csrf_provider')->generateCsrfToken('authenticate')
	        : null;

	    return $this->renderLoginIndex(array(
	                        'last_username' => $lastUsername,
	                        'error' => $error,
	                        'csrf_token' => $csrfToken,
	            ));
	}
    
	    protected function renderLoginIndex(array $data)
    {

        return $this->render('default/index.html.twig', $data);
    }
}

