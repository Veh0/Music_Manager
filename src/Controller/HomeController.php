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

        $filename = 'tracks.xls';

        $artist = new Artist();
        $artist->setName('artist');

        $album = new Album();
        $album->setTitle('testAlbum');

        $a = new Track();
        $a->setTitle('test1')
          ->setAlbum($album)
          ->setArtist($artist)
          ->setDuration(220)
          ->addMedium(new CD());
        $a->addMedium(new Vinyle());
        $ba = new Track();
        $ba->setTitle('test2')
            ->setAlbum($album)
            ->setArtist($artist)
            ->setDuration(120)
            ->addMedium(new Digital());
        $ba->addMedium(new Vinyle());
        $ac = new Track();
        $ac->setTitle('test3')
            ->setAlbum($album)
            ->setArtist($artist)
            ->setDuration(200)
            ->addMedium(new Digital());
        $ac->addMedium(new CD());

        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}