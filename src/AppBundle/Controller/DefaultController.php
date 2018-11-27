<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Hobby;
use AppBundle\Entity\HobbyCollection;
use AppBundle\Form\HobbyCollectionType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {

        $hobbyCollection = new HobbyCollection();

        for ($i = 0; $i < 3; $i++) {
            $hobby = new Hobby();
            $hobby->setName("test");
            $hobby->setAgeStarted($i);
            $hobbyCollection->getHobbyCollection()->add($hobby);
        }

        $hobbiesForm = $this->createForm(HobbyCollectionType::class, $hobbyCollection);

//        $form->handleRequest($request);
//        if ($form->isValid()) {
//            $data = $form->getData();
//        }

        try {
            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        } catch (AccessDeniedException $ex) {
            return $this->redirect($this->generateUrl('fos_user_security_login'));
        }

        // Get the currently logged in user object
        $currentUser = $this->getUser();

        $form = $this->createFormBuilder($currentUser)
            /* Must be a string between 1 and 200 characters, non-nullable */
            ->add('fullName', TextType::class, array(
                    'attr' => array(
                        'minlength' => 1,
                        'maxlength' => 200,
                        'required' => 'required'
                    ))
            )
            /* Must be a string between 0 and 2000 characters, nullable */
            ->add('biography', TextareaType::class, array(
                    'attr' => array(
                        'minlength' => 0,
                        'maxlength' => 2000
                    ),
                    'required' => false
                )
            )
            /* Must be a date input, non-nullable */
            ->add('dateOfBirth', DateType::class)
            /* non-nullable */
            ->add('profileImage', FileType::class, array('label' => 'Profile Image:'))
            ->add('hobbies', CollectionType::class,
                array(
                    'label' => 'Your Hobbies:',
                    'entry_type' => TextType::class,
                    'entry_options' => [
                        'label' => 'Value',
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'prototype' => true,
                    'attr' => array(
                        'class' => 'my-selector',
                    ),
                ))
            ->add('save', SubmitType::class, array('label' => 'Update profile'))
            ->getForm();

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
            'hobbiesForm' => $hobbiesForm->createView(),
            'currentUser' => $currentUser
        ));
    }
}