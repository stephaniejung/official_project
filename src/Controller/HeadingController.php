<?php
namespace App\Controller;

use App\Entity\Heading;
use App\Form\HeadingType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HeadingController extends AbstractController
{
    /**
     * @Route("/heading/new", name="heading_create")
     * @Route("/heading/{id}/edit", name="heading_edit")
     */


    public function form(Heading $heading = null, Request $request, ObjectManager $manager)
    {
        /*$position = $article->getPosition();

        if(isset ($position)){
            return ('changer de position');
        }*/
        if (!$heading) {
            $heading = new Heading();
        }


        $form = $this->createForm(HeadingType::class, $heading);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file

            $heading = $form->getData();


            $file = $form->get('image')->getData();


            if ($file) {
                // moves the file to the directory where brochures are stored
                $file->move(
                    $this->getParameter('images_directory')
                );
            }

            // instead of its contents
            $heading->setImage($file);
            $manager = $this->getDoctrine()->getManager();

            // ... persist the $product variable or any other work
            $manager->persist($heading);
            $manager->flush();

            return $this->redirect($this->generateUrl('heading_show'));
        }

        return $this->render('heading/create.html.twig', [
            'formHeading' => $form->createView(),
            'heading' => $heading,
            'editMode' => $heading->getId() !== null
        ]);

    }

    /**
     * @Route("/heading/delete/{id}", name="heading_delete")
     */
    public function remove(Heading $heading, ObjectManager $manager)
    {
        $id = $heading->getId();
        if (!$heading) {
            throw $this->createNotFoundException(
                'No article found for id7418520.*963.5201'.$id
            );
        }

        $manager->remove($heading);
        $manager->flush();
        return new Response('Delete article'.$id);
    }
    /**
     * @Route("/heading/{id}", name="heading_show")
     */
    public function show(Heading $heading){

        return $this->render('heading/show.html.twig',[
            'heading' => $heading
        ]);
    }
}