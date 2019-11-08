<?php

namespace RoyalAcademyBundle\Controller;

use RoyalAcademyBundle\Entity\Alumno;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use RoyalAcademyBundle\Entity\Usuario;
use RoyalAcademyBundle\Entity\Rolusuario;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserEvents;

/**
 * Alumno controller.
 *
 * @Route("alumno")
 */
class AlumnoController extends Controller
{

    /**
     * Lists all alumno entities.
     *
     * @Route("/", name="alumno_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $alumno = $em->getRepository('RoyalAcademyBundle:Alumno')->findOneBy([
            'usuariousuario' => $user->getId(),
        ]);
        if($alumno== null){
            $response = $this->forward('RoyalAcademyBundle:Alumno:new', [
                'email'  => $user->getEmail(),
            ]);   
            return $response;
        }

        $alumnos = $em->getRepository('RoyalAcademyBundle:Alumno')->findAll();

        return $this->render('alumno/index.html.twig', array(
            'alumnos' => $alumnos,
        ));
    }

    /**
     * Creates a new alumno entity.
     *
     * @Route("/new", name="alumno_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $beforeAlumno = $em->getRepository('RoyalAcademyBundle:Alumno')->findOneBy([
            'usuariousuario' => $user->getId(),
        ]);
        if($beforeAlumno != null){
            $response = $this->forward('RoyalAcademyBundle:Alumno:index');   
            return $response;
        }
        $alumno = new Alumno();
        $form = $this->createForm('RoyalAcademyBundle\Form\AlumnoType', $alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $alumno->setUsuariousuario($user);
            $alumno->setEmail($user->getEmail());
            $em->persist($alumno);
            $em->flush();

            $repository = $em->getRepository(Rolusuario::class);
            $rolObj = $repository->findOneBy([
                'idrolusuario' => 1,
            ]);

            $rol = $rolObj->getRol();

            
            $userManager = $this->container->get('fos_user.user_manager');
            $user->removeRole('ROLE_SINCONF');
            $user->addRole($rol);
            $userManager->updateUser($user);

            $token = new \Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken($user, null, 'main', $user->getRoles()
            );

            $this->container->get('security.context')->setToken($token);
            
            return $this->redirectToRoute('alumno_show', array('idalumno' => $alumno->getIdalumno()));
        }

        return $this->render('alumno/new.html.twig', array(
            'alumno' => $alumno,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a alumno entity.
     *
     * @Route("/datos", name="alumno_show")
     * @Method("GET")
     */
    public function showAction()
    {
        $user = $this->getUser();

        $em = $this->getDoctrine()->getEntityManager();

        $alumno = $em->getRepository('RoyalAcademyBundle:Alumno')->findOneBy([
            'usuariousuario' => $user->getId(),
        ]);

        return $this->render('alumno/show.html.twig', array(
            'alumno' => $alumno,
        ));
    }

    /**
     * Displays a form to edit an existing alumno entity.
     *
     * @Route("/{idalumno}/edit", name="alumno_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Alumno $alumno)
    {
        $deleteForm = $this->createDeleteForm($alumno);
        $editForm = $this->createForm('RoyalAcademyBundle\Form\AlumnoType', $alumno);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('alumno_edit', array('idalumno' => $alumno->getIdalumno()));
        }

        return $this->render('alumno/edit.html.twig', array(
            'alumno' => $alumno,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a alumno entity.
     *
     * @Route("/{idalumno}", name="alumno_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Alumno $alumno)
    {
        $form = $this->createDeleteForm($alumno);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($alumno);
            $em->flush();
        }

        return $this->redirectToRoute('alumno_index');
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/perfil/", name="alumno_show_user")
     * @Method("GET")
     */
    public function showUserAction()
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $userManager = $this->container->get('fos_user.user_manager');
        $email = $user->getEmail();

        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('RoyalAcademyBundle:Alumno')->findOneBy([
            'usuariousuario' => $user->getId(),
        ]);
        return $this->render('@FOSUser/Profile/show.html.twig', array(
            'user' => $user,
            'idalumno' => $alumno->getIdalumno(),
        ));
    }

    /**
     * Edita un usuario
     *
     * @Route("/perfil/editar", name="alumno_edit_user")
     * @Method("GET")
     */
    public function editUserAction(Request $request)
    {
        $user = $this->getUser();

        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException('This user does not have access to this section.');
        }

        $userForm = $this->createForm('RoyalAcademyBundle\Form\ProfileFormType', $user);
        $userForm->handleRequest($request);

        $email = $user->getEmail();

        $em = $this->getDoctrine()->getManager();
        $alumno = $em->getRepository('RoyalAcademyBundle:Alumno')->findOneBy([
            'usuariousuario' => $user->getId(),
        ]);

        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updateUser($user);

            return $this->redirectToRoute('alumno_edit_user');
        }

        return $this->render('@FOSUser/Profile/edit.html.twig', array(
            'form' => $userForm->createView(),
            'idalumno' => $alumno->getIdalumno(),
        ));
    }

    /**
     * Creates a form to delete a alumno entity.
     *
     * @param Alumno $alumno The alumno entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Alumno $alumno)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('alumno_delete', array('idalumno' => $alumno->getIdalumno())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
