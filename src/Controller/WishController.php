<?php

namespace App\Controller;

use App\Repository\WishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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

}
