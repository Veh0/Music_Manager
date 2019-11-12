<?php


namespace App\Controller;

use App\Gateway\TrackGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArtistController
 * @Route("/artist")
 */
class ArtistController extends AbstractController
{
    /**
     * @Route("/", name="artist_index")
     * @param TrackGateway $trackGateway
     * @return Response
     */
    public function index(TrackGateway $trackGateway)
    {
        $fetchArtists = $trackGateway->fetchAllArtist();

        return $this->render("artist/index.html.twig", [
            "page_title" => "Artist",
            "artists" => $fetchArtists
        ]);
    }
}