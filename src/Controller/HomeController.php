<?php

namespace App\Controller;

use App\Entity\Playlist\Playlist;
use App\Entity\Track\Track;
use App\Service\PlaylistManager;
use App\Service\TrackManager;
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