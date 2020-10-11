<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BrandController extends AbstractController
{
    /**
     * @Route("/brands", name="findAllBrand")
     */
    public function showList()
    {
        return $this->render('brand/showList.html.twig', [
            'controller_name' => 'BrandController',
        ]);
    }

    /**
     * @Route("/brand/{id}", name="findBrand", requirements={"id": "\d+"})
     */
    public function show()
    {
        return $this->render('brand/show.html.twig', [
            'controller_name' => 'BrandController',
        ]);
    }
}
