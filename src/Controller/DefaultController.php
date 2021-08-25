<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/default", name="default")
     */
    public function default(): Response
    {

        $personnes[0]["nom"] = "Willis";
        $personnes[0]["prenom"] = "Bruce";
        $personnes[1]["nom"] = "PITT";
        $personnes[1]["prenom"] = "Brad";
        $personnes[2]["nom"] = "CRUISE";
        $personnes[2]["prenom"] = "Tom";

        return $this->render(
            'main/default.html.twig',
            [
                'personnes' => $personnes,
            ]
        );
    }
}
