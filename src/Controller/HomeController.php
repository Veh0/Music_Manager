<?php

namespace App\Controller;

use App\Entity\Album\Album;
use App\Entity\Artist\Artist;
use App\Entity\Media\CD;
use App\Entity\Media\Digital;
use App\Entity\Media\Vinyle;
use App\Entity\Playlist\Playlist;
use App\Entity\Track\Track;
use App\Service\PlaylistManager;
use App\Service\TrackManager;
use PhpOffice\PhpSpreadsheet\Exception;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
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