<?php

namespace App\Controller;

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