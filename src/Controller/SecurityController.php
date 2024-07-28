<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login", methods={"GET", "POST"})
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // If the user is already logged in, redirect to the appropriate page based on roles
        if ($this->getUser()) {
            $roles = $this->getUser()->getRoles();
            if (in_array('ROLE_ADMIN', $roles)) {
                return $this->redirectToRoute('admin_dashboard');
            } else {
                return $this->redirectToRoute('home');
            }
        }

        // Get the login error and last username if there is an error
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        // Render the login form
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
        ]);
    }

    /**
     * @Route("/register", name="app_register", methods={"GET", "POST"})
     */
    public function register(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        // Redirect if the user is already logged in
        if ($this->getUser()) {
            return $this->redirectToRoute('home');
        }

        $user = new User();
        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('message', TextType::class)
            ->add('password', PasswordType::class)
            ->add('confirm_password', PasswordType::class)
            ->add('register', SubmitType::class, ['label' => 'Register'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if ($data->getPassword() === $data->getConfirmPassword()) {
                $plainPassword = $data->getPassword();
                $encodedPassword = $passwordHasher->hashPassword($data, $plainPassword);
                $data->setPassword($encodedPassword);

                $em->persist($data);
                $em->flush();

                return $this->redirectToRoute('app_login');
            } else {
                $this->addFlash('error', 'Passwords do not match.');
            }
        }

        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/my-account", name="my_account", methods={"GET", "POST"})
     */
    public function myAccount(Request $request, EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createFormBuilder($user)
            ->add('name', TextType::class)
            ->add('firstname', TextType::class)
            ->add('email', TextType::class)
            ->add('phone', TextType::class)
            ->add('message', TextType::class)
            ->add('save', SubmitType::class, ['label' => 'Update'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Account updated successfully.');
        }

        return $this->render('security/myaccount.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout(): void
    {
        // Symfony handles the logout process automatically
    }
}