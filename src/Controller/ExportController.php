<?php


namespace App\Controller;


use App\Service\Export\ExportManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ExportController extends AbstractController
{
    /**
     * @Route(path="/export")
     * @param ExportManager $exportManager
     * @return Response
     */
    public function index(ExportManager $exportManager)
    {
        $title = "EXPORT";

        dump($exportManager);

        return $this -> render("base.html.twig", [
            "page_title" => $title
        ]);
    }
}