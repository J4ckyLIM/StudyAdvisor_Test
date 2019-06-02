<?php

namespace App\Controller;

use App\Entity\Bug;
use App\Form\BugType;
use App\Repository\BugRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/bug/new", name="bug_create")
     * @Route("/bug/{id}/edit", name="bug_edit")
     */
    public function form(Bug $bug = null, Request $request, ObjectManager $manager){
        if(!$bug){
            $bug = new Bug();
        }

        $form = $this->createForm(BugType::class, $bug);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $manager->persist($bug);
            $manager->flush();

            return $this->redirectToRoute('bug_show', ['id' => $bug->getId()]);
        }
        return $this->render('bug/create.html.twig', [
            'formBug' => $form->createView()
        ]);
    }

    /**
     * @Route("/bug/{id}", name="bug_show")
     */
    public function show(Bug $bug){
        return $this->render('bug/show.html.twig',[
            'bug' => $bug
        ]);
    }

}