<?php

namespace CursoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * SalonController .
 *
 * @Route("/salones")
 *
 * @author  Pablo Díaz pabldiaz@newtonlabs.com.gt
 */
class SalonController extends Controller
{
    /**
   * @Route("/", name="salones")
   * Mostrar los salones de las clases
   *
   * @param  Request $requst
   *
   * @return Response
   */
  public function showSalonesAction(Request $requst)
  {
      return $this->render('CursoBundle:Salon:indexSalones.html.twig');
  }
}
