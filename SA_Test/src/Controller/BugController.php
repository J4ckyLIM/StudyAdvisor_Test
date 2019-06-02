<?php

namespace App\Controller;

use App\Entity\Bug;
use App\Repository\BugRepository;
use http\Env\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class BugController extends AbstractController
{
    /**
     * @var BugRepository
     */
    private $repository;

    /**
     * @Route("/bug", name="bug")
     */
    public function index(BugRepository $repo){
        $bugs = $repo->findAll();
        return $this->render('bug/index.html.twig',[
            'controller_name' => 'BugController',
            'bugs' => $bugs
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('/bug/home.html.twig');
    }

    /**
     * @Route("/bug/{id}", name="bug_show")
     */
    public function show(Bug $bug){
        return $this->render('bug/show.html.twig',[
            'bug' => $bug
        ]);
    }

    /**
     * @Route("/bug/new", name="bug_create")
     */
    public function create(){
        return $this->render('bug/create.html.twig');
    }
}