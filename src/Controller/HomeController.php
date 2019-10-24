<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $title = "Home";

        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}