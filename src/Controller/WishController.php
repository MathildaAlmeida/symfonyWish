<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\CategoryRepository;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
   
    /**
     * @Route("/admin/ajouter", name="ajouter")
     */
    public function ajouter(Request $request,EntityManagerInterface  $em): Response
    {
        $wish = new Wish();
        
        $formWish = $this->createForm(WishFormType::class,$wish);
        $formWish->handleRequest($request); 
        if ($formWish->isSubmitted())
        {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->persist($wish);
            $em->flush();

            return $this->redirectToRoute('home');

        }
        return $this->render('wish/ajouter.html.twig',
        [ 'formWish' => $formWish->createView()
        ]);
    }

    /**
     * @Route("/admin/ajout_rapide", name="wish_ajout_rapide")
     */
    public function ajoutRapide(Request $request, EntityManagerInterface $em): Response
    {
        // recuprer nom et prenom
        $title = $request->get('title');
        $wish = new Wish();
        $wish->setTitle($title);
        $wish->setIsPublished(true);
        $wish->setDateCreated(new \DateTime());
        $em->persist($wish);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/admin/modifier/{id}", name="wish_modifier")
     */
    public function modifier(Wish $wish, Request $request,EntityManagerInterface  $em): Response
    {
        $formWish = $this->createForm(WishFormType::class,$wish);
        $formWish->handleRequest($request); 
        if ($formWish->isSubmitted())
        {
            $wish->setIsPublished(true);
            $wish->setDateCreated(new \DateTime());
            $em->flush();

            return $this->redirectToRoute('home');

        }
        return $this->render('wish/modifier.html.twig',
        [ 'formWish' => $formWish->createView() ]);
    }

    /**
     * @Route("/admin/supprimer/{id}", name="wish_supprimer")
     */
    public function supprimer(Wish $wish,EntityManagerInterface  $em): Response
    {
         $em->remove($wish);
        $em->flush();

        return $this->redirectToRoute('home');
    }

}
