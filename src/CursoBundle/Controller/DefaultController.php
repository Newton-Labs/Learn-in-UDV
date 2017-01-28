<?php

namespace CursoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * Default Index page.
     * 
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
         $usuario = $this->getUser();
        return $this->render('default/index.html.twig', [
          'token' => $usuario->getApiToken()
        ]);
    }
}
