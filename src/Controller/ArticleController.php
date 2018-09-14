<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 14/09/18
 * Time: 11:58
 */

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Heading;
use App\Form\ArticleType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class ArticleController extends AbstractController
{
    /**
     * @Route("/article/new", name="article_create")
     * @Route("/article/{id}/edit", name="article_edit")
     */


    public function form(Article $article = null, Request $request, ObjectManager $manager)
    {

        if (!$article) {
            $article = new Article();
        } else {
            $article->setUpdatedAt(new \DateTime());
        }

        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file

            $article = $form->getData();


            $fileData = $form->get('file')->getData();
            if ($fileData) {

                $fileName = md5(uniqid()) . '.' . $fileData->guessExtension();

                $fileData->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $fileNew = $this->getParameter('images_directory') . '/' . $article->getImage();

                if (file_exists($fileNew)) {

                    unlink($fileNew);

                }


                // instead of its contents
                $article->setImage($fileName);
            }
            $manager = $this->getDoctrine()->getManager();

            // ... persist the $product variable or any other work
            $manager->persist($article);
            $manager->flush();

            return $this->redirect($this->generateUrl('article_show'));

        }
        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'article' => $article,
            'editMode' => $article->getId() !== null
        ]);

    }

    /**
     * @Route("/article/delete/{id}", name="article_delete")
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(Article::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id' . $id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new Response('Delete article' . $id);
    }

    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function show(Article $article)
    {

        return $this->render('article/show.html.twig', [
            'controller_name' => 'ArticleController',
            'article' => $article
        ]);
    }

}
