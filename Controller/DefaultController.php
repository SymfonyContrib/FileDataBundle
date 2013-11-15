<?php

namespace SymfonyContrib\Bundle\FileDataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FileDataBundle:Default:index.html.twig', array('name' => $name));
    }
}
