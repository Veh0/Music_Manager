<?php

namespace App\Controller;

use App\Repository\MediumRepository;
use App\Repository\TrackRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController {

    /**
     * @Route("/", name="home")
     * @param TrackRepository $trackRepository
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(MediumRepository $trackRepository)
    {
        $title = "Home";

        dd($trackRepository->findAll());


        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}