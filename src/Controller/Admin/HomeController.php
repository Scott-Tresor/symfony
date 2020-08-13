<?php 

namespace  App\Admin\Controller;

use App\Repository\PinsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/admin/index", name="home_page", methods="GET")
     * @param PinsRepository $pins
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function index(PinsRepository $pins): Response
    {
        $pin = $pins->findBy([], ['createdAt' => 'DESC']);
        return $this->render('admins/homes/index.html.twig', compact('pin'));
    }
}