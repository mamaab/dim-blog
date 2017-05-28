<?php

namespace Dim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Dim\BlogBundle\Repository\ArticleRepository;

/**
 *
 * @Route("/article", name="article", service="dim.article_controller")
 */
class ArticleController
{
    private $templating;
    private $em;
    private $articleRepository;

    public function __construct(
        EngineInterface $templating,
        EntityManager $em,
        ArticleRepository $articleRepository)
    {
        $this->templating = $templating;
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }

    public function indexAction()
    {
        return $this->templating->renderResponse(
            'DimBlogBundle:Article:index.html.twig', []
        );
    }

    public function listAction()
    {
        $articles = $this->articleRepository->getAllArticle();
///var_dump($articles); die;
        return $this->templating->renderResponse(
            'DimBlogBundle:Article:list.html.twig', ['articles' => $articles]
        );
    }

    public function showAction($id)
    {
        $article = $this->articleRepository->getArticle($id);
        //var_dump($article); die;
        return $this->templating->renderResponse(
            'DimBlogBundle:Article:show.html.twig', ['article' => $article]
        );
    }

}
