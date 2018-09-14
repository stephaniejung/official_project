<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\News;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function shownews(News $news)
    {
        return $this->render('news/new_show.html.twig', [
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
}
