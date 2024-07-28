<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(ReservationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form data here

            return $this->redirectToRoute('success'); // Redirect after submission
        }

        return $this->render('reservation_form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}