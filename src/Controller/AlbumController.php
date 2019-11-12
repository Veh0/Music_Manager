<?php


namespace App\Controller;


use App\Entity\Album\Album;
use App\Form\Type\AlbumType;
use App\Gateway\TrackGateway;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/", name="album_index")
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

    public function add(Request $request)
    {
        $album = new Album();

        $form = $this->createForm(AlbumType::class, $album);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($album);
            $manager->flush();

            return $this->redirectToRoute("index_track");
        }


        return $this->render('track/new.html.twig', [
            "page_title" => "Track | Add",
            "form" => $form->createView()
        ]);
    }
}