<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\UserRepository;
use App\Repository\ProductRepository;
use App\Service\ProductUploadManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index", methods={"GET"})
     
    *public function index(ProductRepository $productRepository): Response
    *{
    *   return $this->render('product/index.html.twig', [
    *        'products' => $productRepository->findAll(),
    *    ]);
    *}
    */

    /**
     * @Route("/new", name="product_new", methods={"GET","POST"})
    
     */
    public function new(Request $request, ProductUploadManager $productUploadManager): Response
    {
        $product = new Product();
       
        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        $id = $this->getUser()->getId();
        if ($form->isSubmitted() && $form->isValid()) {

            // On associe le user connecté à l'annonce
            $product->setUser($this->getUser($id));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

            // on utilise la méthode upload() et on stocke la valeur retournée (= le chemin du fichier)
            $imagePath = $productUploadManager->upload($form['picture'], $product->getId());
            // on utilise setImage()
            $product->setPicture($imagePath);
            // on flush
            $entityManager->flush();

            return $this->redirectToRoute('product_show', [ 
                'id' => $product->getId(),
            ]);
        }

        return $this->render('product/new.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="product_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Product $product,ProductUploadManager $productUploadManager): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);
        $id = $this->getUser()->getId();
        
        if ($form->isSubmitted() && $form->isValid()) {
            // On associe le user connecté à l'annonce
            $product->setUser($this->getUser($id));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($product);
            $entityManager->flush();

             // on utilise la méthode upload() et on stocke la valeur retournée (= le chemin du fichier)
             $imagePath = $productUploadManager->upload($form['picture'], $product->getId());
             if (!($product->getPicture() !== null && $imagePath == null)) {
                 $product->setPicture($imagePath);
             }
             $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_show', [ 
                'id' => $product->getId(),
            ]);
        }


        return $this->render('product/edit.html.twig', [
            'product' => $product,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="product_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Product $product): Response
    {
        if ($this->isCsrfTokenValid('delete' . $product->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($product);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }
}
