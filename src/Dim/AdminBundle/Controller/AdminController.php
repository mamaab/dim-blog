<?php

namespace Dim\AdminBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
//use Symfony\Component\Routing\Router; //RouterInterface;
//use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactory;
use Dim\BlogBundle\Entity\Article;
use Dim\BlogBundle\Form\ArticleTypeOld;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class AdminController
{
    private $templating;
    private $em;
    private $formFactory;
    private $router;
    protected $tokenStorage;


    public function __construct(
        EngineInterface $templating,
        EntityManager $em,
        FormFactory $formFactory,
        Router $router,
        TokenStorage $tokenStorage) {
        $this->templating = $templating;
        $this->em = $em;
        $this->formFactory = $formFactory;
        $this->router = $router;
        $this->tokenStorage = $tokenStorage;
    }

    public function createForm($type, $data = null, array $options = array())
    {
        return $this->formFactory->create($type, $data, $options);
    }

    public function indexAction()
    {
        if (!$this->tokenStorage->getToken()->getRoles('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        return $this->templating->renderResponse(
            'DimAdminBundle:Admin:index.html.twig', []
        );
    }

    public function createAction(Request $request)
    {
        if (!$this->tokenStorage->getToken()->getRoles('ROLE_ADMIN')) {
            throw new AccessDeniedException();
        }

        $article = new Article();

        $form = $this->formFactory->create(ArticleTypeOld::class, $article);
        //createFormBuilder
        $form->handleRequest($request);

        // the isSubmitted() method is completely optional because the other
        // isValid() method already checks whether the form is submitted.
        // However, we explicitly add it to improve code readability.
        // See http://symfony.com/doc/current/best_practices/forms.html#handling-form-submits
        if ($form->isSubmitted() && $form->isValid()) {

            $article = $form->getData();
            $this->em->persist($article);
            $this->em->flush();
            $response = new RedirectResponse($this->router->generate('dim_admin_create_article'));
            return $response;
            //return $this->router->generate('dim_admin_new_article') ;
        }

        return $this->templating->renderResponse('DimAdminBundle:Admin:Article/create.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

}
