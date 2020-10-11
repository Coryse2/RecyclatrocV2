<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index( ProductRepository $productRepository,  UserRepository $userRepository,  CategoryRepository $categoryRepository)
    {
       
        return $this->render('main/index.html.twig', [
            'products' => $productRepository->findFive(),
            'users' => $userRepository->findAll(),
            'categories' => $categoryRepository->findAll(),
        ]);
         //dd($products);
    }

    /**
     * @Route("/about", name="about")
     */
    public function about()
    {
        return $this->render('main/about.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/legale_notice", name="legalNotice")
     */
    public function notice()
    {
        return $this->render('main/notice.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

}
