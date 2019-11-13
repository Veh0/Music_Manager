<?php


namespace App\Controller;


use App\Service\Playlist\PlaylistManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PlaylistController extends AbstractController
{
    /**
     * @Route("/playlist", name="playlist_generator")
     * @param PlaylistManager $playlistManager
     * @return Response
     */
    public function index(PlaylistManager $playlistManager)
    {
        $criterias = [
            "max_count",
            "max_duration",
            "style"
        ];

        return $this->render('playlist/generator.html.twig', [
            "page_title" => "Playlist | Generator",
            "criterias" => $criterias
        ]);
    }
}