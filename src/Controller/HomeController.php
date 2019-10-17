<?php

namespace App\Controller;

use App\Entity\Track;
use App\Entity\Album;
use App\Entity\Vinyl;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class HomeController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index()
    {
        $title = "Home";

        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}