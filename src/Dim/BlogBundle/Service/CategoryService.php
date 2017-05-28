<?php

namespace Dim\BlogBundle\Service;

use Doctrine\ORM\EntityManager;
use Dim\BlogBundle\Entity\Category;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryService
 *
 * @author root
 */
class CategoryService {

    /**
     * @var EntityManager
     */
    private $em;

    /**
     * Constructeur
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    /**
     * Liste de toutes les catégories
     * @return Category
     */
    public function findAllCategories() {
//        return $this->em->createQuery(
//            'SELECT c FROM DimBlogBundle:Category c'
//        )
//            ->getResult();
    }

}
