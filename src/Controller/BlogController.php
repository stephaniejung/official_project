<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Heading;
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;
use App\Twig\AppExtension;

class BlogController extends AbstractController
{
    /**
     * @Route("/blog", name="blog")
     */
    public function index(ArticleRepository $repo)
    {
        /*$repo = $this
            ->getDoctrine()
            ->getRepository(Article::class);*/
        $articles = $repo ->findAll();

        return $this->render('blog/index.html.twig', [
            'title' => "Les actualités",
            'articles' => $articles
        ]);
    }

    /**
     * @Route("/heading/{id}", name="heading_show")
     */
    public function show(Heading $heading) // creer une variable $page qui sera de type Page
    {
        return $this->render('blog/heading_show.html.twig',[
            'controller_name' => 'PageController',
            'title' => $heading->getTitle(),
            'subtitle' => $heading->getSubtitle(),
            'description' => $heading->getDescription(),
            'heading' => $heading

        ]);
    }
    /**
     * @Route("/article/{id}", name="article_show")
     */
    public function showarticle(Article $article){
        // creer une variable article qui sera de type Article
        return $this->render('blog/article_show.html.twig',[
            'controller_name' => 'ArticleController',
            'title' => $article->getTitle(),
            'article'=> $article

        ]);
    }
}
