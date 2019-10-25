<?php


namespace App\Controller;

use App\Gateway\TrackGateway;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Class AjaxController
 * @Route("/ajax")
 */
class AjaxController extends AbstractController
{
    /**
     * @Route("/order", name="order_ajax")
     * @param Request $request
     * @param TrackGateway $trackGateway
     * @return JsonResponse
     */
    public function orderList(Request $request, TrackGateway $trackGateway)
    {
        $orderBy = $request->request->get("data");

        $entity = $request->request->get("entity");

        $orderFunction = 'fetchOrder'.$entity.'s';

        $fetchTracks = $trackGateway->$orderFunction($orderBy);

        return new JsonResponse($fetchTracks);
    }
}