<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use\Swift_Attachment;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index(Request $request, \Swift_Mailer $mailer)

    {

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactFormData = $form->getData();

            dump($contactFormData);


            $message = (new \Swift_Message('Message de Réciprocité!'))
                ->setFrom($contactFormData['from'])
                ->setTo('reciprociteassociation@gmail.com')
                ->setBody(
                    $contactFormData['message'],
                   'text/plain'
                )

            ;
            $attachment = Swift_Attachment::fromPath($contactFormData ['file'])
            ->setFilename('fichier joint');
            $message->attach($attachment);

            $mailer->send($message);

            $this->addFlash('success', 'Message envoyé!');

            return $this->redirectToRoute('contact');
        }

        return $this->render('contact/index.html.twig', [

            'our_form' => $form->createView(),
            'controller_name' => 'ContactController',
            'title' => 'Nous contacter',
        ]);
    }
}
