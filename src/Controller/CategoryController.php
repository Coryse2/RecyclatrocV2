<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/categories", name="findAllCategory")
     */
    public function showList()
    {
        return $this->render('category/showList.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/{id}", name="findCategory")
     */
    public function show()
    {
        return $this->render('category/show.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }
}
