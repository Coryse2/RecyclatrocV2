<?php

namespace App\Controller;

use App\Form\CitySearchType;
use App\Form\BrandSearchType;
use App\Form\CategorySearchType;
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
        $formSearchProduct = $this->createForm(CitySearchType::class);
        $formSearchProduct->handleRequest($request);
        if ($formSearchProduct->isSubmitted() && $formSearchProduct->isValid())
        {
            $critere = $formSearchProduct->getData();
            $products = $productRepository->searchCity($request->request->get('product_search'));
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

        /**
     * @Route("/search/brands", name="search_brands")
     */
    public function searchBrand(Request $request, ProductRepository $productRepository): Response
    {

        $products = [];
        $formSearchProduct = $this->createForm(BrandSearchType::class);
        $formSearchProduct ->handleRequest($request);
        if ($formSearchProduct ->isSubmitted() && $formSearchProduct->isValid())
        {
            $critere = $formSearchProduct ->getData();
            $products = $productRepository->searchBrand($request->request->get('brand_search'));
        }

        return $this->render('search/brands.html.twig', [
            'form' => $formSearchProduct ->createView(),
            'products'=> $products,
        ]);
    }
}