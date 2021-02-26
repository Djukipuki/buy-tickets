<?php


namespace App\Controller;


use App\Api\AirTicketsApi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchTransportRoutesController extends AbstractController
{
    private $airTicketsApi;

    public function __construct(AirTicketsApi $airTicketsApi)
    {
        $this->airTicketsApi = $airTicketsApi;
    }

    /** @Route(name="homepage")  */
    public function index(Request $request): Response
    {
        $searchResult = $request->get('searchResult');

        if($searchResult) {
            $searchResult = $this->airTicketsApi->decode($searchResult);
        }

        return $this->render('index.html.twig', [
            'searchResult' => $searchResult
        ]);
    }

    /** @Route("/search/", name="search") */
    public function search(Request $request): Response
    {
        $data = $request->request->all();

        if(!$data) {
            return $this->redirectToRoute('homepage');
        }

        return $this->redirectToRoute('homepage', [
            'searchResult' => $this->airTicketsApi->search($data),
        ]);
    }
}