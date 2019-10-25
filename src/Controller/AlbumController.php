<?php


namespace App\Controller;


use App\Gateway\TrackGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AlbumController
 * @Route("/album")
 */
class AlbumController extends AbstractController
{
    /**
     * @Route("/")
     * @param TrackGateway $trackGateway
     * @return Response
     */
    public function index(TrackGateway $trackGateway)
    {
        $fetchAlbums= $trackGateway->fetchAllAlbums();

        return $this->render("album/index.html.twig", [
            "page_title" => "Album",
            "albums" => $fetchAlbums
        ]);
    }
}