<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends Controller
{
    /**
     * @Route("/profile")
     */
    public function profileAction()
    {
        return new Response('<html><body>Profile page!</body></html>');
    }
}