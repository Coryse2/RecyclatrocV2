<?php 

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, Swift_Mailer $mailer)
    {
        $contact = new Contact;
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
          $form->getData();

        if(!empty($email)){
        // Spam detected!    
          $this->addFlash('warning', '🐛 SPAM detected');
          return $this->redirectToRoute('home');
        
        } else {

            //here we send the email
            $message = (new Swift_Message('Nouveau Contact'))
                //sender
                // Note : the sender is information because we used Email for the honeypot
                ->setFrom($contact->getInformation())
                //recipient
                ->setTo('recyclatroc@gmail.com')

                //creation of the message and the view
                ->setBody(
                    $this->renderView(
                        'emails/contact.html.twig',
                        compact('contact')
                        //compact equals an array
                    ),
                    'text/html'
                );
            //sending the message
            $mailer->send($message);
            $this->addFlash('success', 'Votre email a bien été envoyé');
            return $this->redirectToRoute('home');
        }

    }
        return $this->render('contact/index.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
}
}