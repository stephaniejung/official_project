<?php

namespace App\Controller;

use App\Entity\Heading;
use App\Entity\Article;
use App\Entity\Partner;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $headings = $this->getDoctrine()
            ->getRepository(Heading::class)
            ->findAll();

        $partners = $this->getDoctrine()
            ->getRepository(Partner::class)
            ->findAll();

        return $this->render('home/index.html.twig', [
            'controller_name' => "Réciprocité association d'insertion",
            'articles'=> $articles,
            'headings'=> $headings,
            'partners'=> $partners,


        ]);
    }
    /**
     * @Route("/layout", name="test")
     */
    public function indextest()
    {
        return $this->render('layout_sidebar.html.twig', [
            'controller_name' => 'HomeController2',
        ]);
    }


}
