<?php


namespace App\Controller;


use App\Service\Playlist\PlaylistManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlaylistController extends AbstractController
{
    /**
     * @Route("/playlist")
     * @param PlaylistManager $playlistManager
     * @return Response
     */
    public function index(PlaylistManager $playlistManager)
    {
        dump($playlistManager);

        return new Response();
    }
}