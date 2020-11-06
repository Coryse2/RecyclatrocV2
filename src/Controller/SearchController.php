<?php

namespace App\Controller;

use App\Form\CategorySearchType;
use App\Form\LocationSearchType;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{
    /**
     * @Route("/search/cities", name="search_cities")
     */
    public function searchCity(Request $request, ProductRepository $productRepository): Response
    {

        $products = [];
        $formSearchProduct = $this->createForm(LocationSearchType::class);
        $formSearchProduct->handleRequest($request);
        if ($formSearchProduct->isSubmitted() && $formSearchProduct->isValid())
        {
            $critere = $formSearchProduct->getData();
            $products = $productRepository->searchByCity($request->request->get('product_search'));
        }

        return $this->render('search/cities.html.twig', [
            'form' => $formSearchProduct->createView(),
            'products'=> $products,
        ]);
    }

    /**
     * @Route("/search/categories", name="search_categories")
     */
    public function searchCategory(Request $request, ProductRepository $productRepository): Response
    {

        $products = [];
        $formSearchProduct = $this->createForm(CategorySearchType::class);
        $formSearchProduct ->handleRequest($request);
        if ($formSearchProduct ->isSubmitted() && $formSearchProduct->isValid())
        {
            $critere = $formSearchProduct ->getData();
            $products = $productRepository->searchCategory($request->request->get('category_search'));
        }

        return $this->render('search/categories.html.twig', [
            'form' => $formSearchProduct ->createView(),
            'products'=> $products,
        ]);
    }
}