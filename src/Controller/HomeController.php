<?php

namespace App\Controller;

use App\Repository\MediumRepository;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param MediumRepository $trackRepository
     * @return Response
     */
    public function index(MediumRepository $trackRepository)
    {
        $title = "Home";

        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}