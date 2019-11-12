<?php


namespace App\Controller;


use App\Entity\Track\Track;
use App\Form\Type\TrackType;
use App\Gateway\TrackGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TrackController
 * @Route("/track")
 */
class TrackController extends AbstractController
{
    /**
     * @Route("/", name="track_index")
     * @param TrackGateway $trackGateway
     * @return Response
     */
    public function index(TrackGateway $trackGateway)
    {
        $fetchTracks = $trackGateway->fetchAllTracks();

        return $this->render('track/index.html.twig', [
            "page_title" => "Track",
            "tracks" => $fetchTracks
        ]);
    }

    /**
     * @Route("/new", name="new_track", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     */
    public function add(Request $request)
    {
        $track = new Track();

        $form = $this->createForm(TrackType::class, $track);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid())
        {
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($track);
            $manager->flush();

            return $this->redirectToRoute("index_track");
        }


        return $this->render('track/new.html.twig', [
            "page_title" => "Track | Add",
            "form" => $form->createView()
        ]);
    }
}