<?php

namespace Dim\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Request;
use FOS\UserBundle\Model\UserInterface;


/**
 * Class UserController
 * @package Dim\UserBundle\Controller
 *
 */
class UserController {

    private $templating;
    private $em;

    public function __construct(EngineInterface $templating, EntityManager $em) {
        $this->templating = $templating;
        $this->em = $em;
    }

    public function indexAction()
    {
        $users = $this->em->getRepository('DimUserBundle:User')->findAll();

        return $this->templating->renderResponse(
            'DimUserBundle:User:index.html.twig',
            ['users' => $users]
        );
    }

    public function showAction($id) {

        $user = $this->em->getRepository('DimUserBundle:User')->find($id);
        return $this->templating->renderResponse(
            'DimUserBundle:User:show.html.twig',
            ['user' => $user]
        );

    }

}
