<?php

namespace App\Controller;

use \Swift_Attachment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;

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


            // je récupère mes données
            $service = $form->get('service');
            $subjectKey = $form->get('subject');
            $from = $form->get('from');
            $body = $form->get('message');
            $file = $form->get('file');

            $subjectsList = [
                "mediation" => 'testdevprojet@gmail.com',
                "technique" => 'reciprociteassociation@gmail.com',
                "insertion" => 'testdevprojet2@gmail.com'
            ];

            $subject = $subjectsList[$subjectKey];


            //je construis le message à envoyer
            $message = (new \Swift_Message())
                ->setFrom($from)
                ->setTo($service)
                ->setSubject($subject)
                ->setBody(
                    $body,
                    'text/plain');
            //s'il y a un fichier PDF, je l'envoie
            if (!empty($file)) {
                $attachment = Swift_Attachment::fromPath($file)->setFilename('fichier.pdf');

                $message->attach($attachment);
            }


            $mailer->send($message);


            $this->addFlash('success', 'Message envoyé!');

            return $this->redirectToRoute('contact');

        }
        $form = $this->createForm(ContactType::class);
        return $this->render('contact/index.html.twig', [

            'our_form' => $form->createView(),
            'controller_name' => 'ContactController',
            'title' => 'Nous contacter',

        ]);
    }

}