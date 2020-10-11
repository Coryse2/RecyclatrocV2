<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\LoginType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login", name="app_login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
    
    // get the login error if there is one
    $error = $authenticationUtils->getLastAuthenticationError();

    // last username entered by the user
    $lastUsername = $authenticationUtils->getLastUsername();
    
    $form = $this->createForm(LoginType::class, [
        'login[_username]' => $lastUsername,
    ]);
     

    return $this->render('security/login.html.twig', [
        'last_username' => $lastUsername,
        'form' => $form->createView(),
        'error'         => $error,
    ]);
    
    }

     /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request) {

      }
}
