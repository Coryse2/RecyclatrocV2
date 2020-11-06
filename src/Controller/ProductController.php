<?php

namespace App\Controller;


use App\Entity\Product;
use App\Entity\Location;
use App\Form\ProductType;
use App\Service\ProductUploadManager;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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

        $location= new Location();
        $location->setCity('Paris');
        $product->addLocation($location);
        // save the records that are in the database first to compare them with the new one the user sent
        // make sure this line comes before the $form->handleRequest();
        $orignalLocation = new ArrayCollection();
        foreach ($product->getLocation() as $location) {
            $orignalLocation->add($location);
        }

        
        $id = $this->getUser()->getId();

       $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On associe le user connecté à l'annonce
            $product->setUser($this->getUser($id));


            // get rid of the ones that the product got rid of in the interface (DOM)
            foreach ($orignalLocation as $location) {
                // check if the loction is in the $product->getLocation()
                if ($product->getLocation()->contains($location) === false) {
                    $product->removeLocation($location);
                }
            }

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
            ]); dump($product);
        }
        return $this->render('product/new.html.twig', [
            'product' => $product,
            'location'=> $location,   
            'form' => $form->createView(),
        ]);
        
    }

    /**
     * @Route("/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product, Location $location): Response
    {   
        $product->getLocation()->contains($location);
        return $this->render('product/show.html.twig', [
            'product' => $product,
            'location'=>$location,
            dump($product)
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
