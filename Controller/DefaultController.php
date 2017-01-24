<?php

namespace Viweb\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ViwebMediaBundle:Default:index.html.twig');
    }
}
