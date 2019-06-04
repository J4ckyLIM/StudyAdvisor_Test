<?php

namespace App\Controller;

use App\Entity\User;

use App\Form\RegistrationType;
use App\Repository\UserRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $reposity;

    /**
     * @Route("/signup", name="user_registration")
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
        $user = new User();
        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            $hash = $encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($hash);
            $manager->persist($user);
            $manager->flush();
            return $this->redirectToRoute('user_login');
        }

        return $this->render('user/signup.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/signin", name="user_login")
     */
    public function login(){
        return $this->render('user/signin.html.twig');
    }

    /**
     * @Route("/logout", name="user_logout")
     */
    public function logout(){}
}