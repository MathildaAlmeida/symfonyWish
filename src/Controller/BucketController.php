<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BucketController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(WishRepository $repo): Response
    {
       $wishes = $repo->findBy(['isPublished'=> true],['dateCreated'=>'DESC']);
     
        return $this->render('bucket/home.html.twig', [
            'wishes' => $wishes
        ]);
    }
    /**
     * @Route("/detail/{id}", name="detail")
     */
    public function detail(Wish $wish, WishRepository $repo): Response
    {
       //dd($wish);
       $id = $wish->getId();
       
       $wishes =  $repo->findById($id);
        return $this->render('bucket/detail.html.twig', [
            'wishes' => $wishes
        ]);
    }
    

    /**
     * @Route("/about-us", name="about_us")
     */
    public function about(): Response
    {
        return $this->render('bucket/about.html.twig');
    }
}