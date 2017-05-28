<?php

namespace Dim\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\EngineInterface;
use Doctrine\ORM\EntityManager;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;
use Dim\BlogBundle\Repository\ArticleRepository;

class BlogController
{
    private $templating;
    private $em;
    private $articleRepository;

    public function __construct(
        EngineInterface $templating,
        EntityManager $em,
        ArticleRepository $articleRepository
) {
        $this->templating = $templating;
        $this->em = $em;
        $this->articleRepository = $articleRepository;
    }

    public function indexAction()
    {
        $articles = $this->articleRepository->getAllArticle();
       // empty($articles)
//var_dump($articles); die;
        return $this->templating->renderResponse(
            'DimBlogBundle:Blog:index.html.twig', ["articles" => $articles]
        );
    }

    public function allArticleAction()
    {
        /*$query = $this->em
            ->createQuery(
                'select a from DimBlogBundle:Article a'
            );

        $query->useResultCache(true, 30,'all_articles_key');
        //$query->setResultCacheLifetime(3600); //3600sec = 1 hour

        return new Response(json_encode($query->getResult()));*/
    }

}
