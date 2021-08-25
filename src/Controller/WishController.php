<?php

namespace App\Controller;

use App\Entity\Wish;
use App\Form\WishFormType;
use App\Repository\WishRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WishController extends AbstractController
{
    /**
     * @Route("/wish", name="wish")
     */
    public function wish(WishRepository $repoWish): Response
    {
        $tab = $repoWish->findBy(array(), array('dateCreated' => 'DESC'));

        return $this->render('wish/wish.html.twig', [
            'liste_wish' => $tab,
        ]);
    }

    /**
     * @Route("/wish/detail/{id}", name="detail")
     */
    public function detail(String $id): Response
    {
        return $this->render('wish/detail.html.twig', [
            'id' => $id,
        ]);
    }

    /**
     * @Route("/wish/ajouter", name="wish_ajouter")
     */
    public function wishAjouter(Request $request, EntityManagerInterface $em): Response
    {
        $wish = new Wish();

        $formWish = $this->createForm(WishFormType::class, $wish);
        $formWish->handleRequest($request);

        if ($formWish->isSubmitted()){
            $em->persist($wish);
            $em->flush();
            return $this->redirectToRoute('wish');
        }


        return $this->render('wish/ajouter.html.twig', [
            'formWish' => $formWish->createView(),
        ]); 
    }


}
