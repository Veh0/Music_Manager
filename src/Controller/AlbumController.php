<?php


namespace App\Controller;


use App\Entity\Album\Album;
use App\Form\Type\AlbumType;
use App\Gateway\TrackGateway;
use Symfony\Component\HttpFoundation\RedirectResponse;
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

    /**
     * @Route("/new", name="new_album", methods={"GET", "POST"})
     * @param Request $request
     * @return RedirectResponse|Response
     */
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

            return $this->redirectToRoute("album_index");
        }


        return $this->render('album/new.html.twig', [
            "page_title" => "Album | Add",
            "form" => $form->createView()
        ]);
    }
}