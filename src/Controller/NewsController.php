<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class NewsController extends AbstractController
{
    /**
     * @Route("/actualites", name="actualites")
     */
    public function index(NewsRepository $repo)
    {
        $news = $repo ->findAll();

        return $this->render('news/index.html.twig', [
            'controller_name' => 'NewsController',
            'title' => "Les actualités",
            'news' => $news
        ]);
    }
    /**
     * @Route("/actualites/{id}", name="news_show")
     */


    public function form(News $news = null, Request $request, ObjectManager $manager)
    {

        if (!$news) {
            $news = new News();
        } else {
            $news->setUpdatedAt(new \DateTime());
        }

        $form = $this->createForm(NewsType::class, $news);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file

            $news = $form->getData();


            $fileData = $form->get('file')->getData();
            if ($fileData) {

                $fileName = md5(uniqid()) . '.' . $fileData->guessExtension();

                $fileData->move(
                    $this->getParameter('images_directory'),
                    $fileName
                );
                $fileNew = $this->getParameter('images_directory') . '/' . $news->getImage();

                if (file_exists($fileNew)) {

                    unlink($fileNew);

                }


                // instead of its contents
                $news->setImage($fileName);
            }
            $manager = $this->getDoctrine()->getManager();

            // ... persist the $product variable or any other work
            $manager->persist($news);
            $manager->flush();

            return $this->redirect($this->generateUrl('news_show'));

        }
        return $this->render('article/create.html.twig', [
            'formArticle' => $form->createView(),
            'news' => $news,
            'title' => $news->getTitle(),
        ]);
    }
    /**
     * @Route("/actualites/categorie/{id}", name="category_show")
     */
    public function show(Category $category) // creer une variable $page qui sera de type Page
    {
        return $this->render('news/category_show.html.twig', [
            'controller_name' => 'PageController',
            'name' => $category->getName(),
            'category' => $category

        ]);
    }
    /**
     * @Route("/news/delete/{id}", name="news_delete")
     */
    public function remove($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $article = $entityManager->getRepository(News::class)->find($id);
        if (!$article) {
            throw $this->createNotFoundException(
                'No article found for id' . $id
            );
        }

        $entityManager->remove($article);
        $entityManager->flush();

        return new Response('Delete news' . $id);
    }

}
