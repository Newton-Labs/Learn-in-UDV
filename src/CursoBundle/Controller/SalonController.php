<?php

namespace CursoBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use CursoBundle\Entity\Curso;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use CursoBundle\Form\Type\BuscarType;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * SalonController .
 * @Route("/salones")
 * @author  Pablo Díaz pabldiaz@newtonlabs.com.gt
 */
class SalonController extends Controller
{
  /**
   * @Route("/", name="salones")
   * Mostrar los salones de las clases
   * @param  Request $requst 
   * @return Response
   */
  public function showSalonesAction(Request $requst) 
  {
    return $this->render('CursoBundle:Salon:indexSalones.html.twig');
  }
}