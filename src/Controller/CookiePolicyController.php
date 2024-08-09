<?php
/// src/Controller/CookiePolicyController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CookiePolicyController extends AbstractController
{
    /**
     * @Route("/cookie-policy", name="cookie_policy")
     */
    public function index(): Response
    {
        return $this->render('cookie_policy.html.twig');
    }
}