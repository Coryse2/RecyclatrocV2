<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Product;
use App\Entity\Location;
use App\Repository\UserRepository;
use App\Service\FileUploadManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/", name="user_index", methods={"GET"})
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_show", methods={"GET"})
     */
    public function show(User $user, Product $product, Location $location): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
            'product' => $product,
            'location' => $location,
            dump($location)
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder, FileUploadManager $fileUploadManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plainPassword = $user->getPassword();
            $encodedPassword = $encoder->encodePassword($user, $plainPassword);
            $user->setPassword($encodedPassword);



            // on utilise la méthode upload() et on stocke la valeur retournée (= le chemin du fichier)
            $imagePath = $fileUploadManager->upload($form['avatar'], $user->getId());
            if (!($user->getAvatar() !== null && $imagePath == null)) {
                $user->setAvatar($imagePath);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_show', [
                'id' => $user->getId(),
            ]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete")
     *
     */
    public function delete(Request $request, User $user, $id): Response
    {

        $currentUserId = $this->getUser()->getId();
        if ($currentUserId == $id) {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/{id}/products", name="user_products", methods={"GET"})
     */
    public function userProduct(User $user): Response
    {
        return $this->render('user/products.html.twig', [
            'user' => $user,
        ]);
    }
}
