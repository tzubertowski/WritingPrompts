<?php

namespace PromptBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PromptBundle:Default:index.html.twig', array('name' => $name));
    }
}
