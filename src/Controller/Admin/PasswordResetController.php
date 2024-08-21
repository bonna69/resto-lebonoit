<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PasswordResetController extends AbstractController
{
    #[Route('/password_reset', name: 'password_reset')]
    public function index(Request $request, EntityManagerInterface $entityManager, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = $this->getUser();
        
        if (!$user) {
            return $this->redirectToRoute('admin_login');
        }

        $form = $this->createFormBuilder()
            ->add('new_password', PasswordType::class, [
                'label' => 'New Password',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please enter the new password.']),
                    new Assert\Length(['min' => 6, 'minMessage' => 'Password must have at least {{ limit }} characters.']),
                ],
            ])
            ->add('confirm_password', PasswordType::class, [
                'label' => 'Confirm Password',
                'constraints' => [
                    new Assert\NotBlank(['message' => 'Please confirm the password.']),
                    new Assert\EqualTo(['propertyPath' => 'new_password', 'message' => 'Password did not match.']),
                ],
            ])
            ->add('save', SubmitType::class, ['label' => 'Reset Password'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $newPassword = $data['new_password'];

            // Update the password
            $user->setPassword($passwordEncoder->encodePassword($user, $newPassword));
            $entityManager->flush();

            // Log out the user and redirect to login page
            $this->get('security.token_storage')->setToken(null);
            $this->get('session')->invalidate();
            return $this->redirectToRoute('admin_login');
        }

        return $this->render('admin/password_reset.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}