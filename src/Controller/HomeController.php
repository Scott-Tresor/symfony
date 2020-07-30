<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Repository\PinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param PinsRepository $pins
     * @return Response
     */
    public function index(PinsRepository $pins): Response
    {
        $pin = $pins->findAll();
        return $this->render('home/index.html.twig', compact('pin'));
    }

    /**
     * @Route("/pins/{id<[0-9]+>}" name="detail")
     * @param Pins $pins
     * @return Response
     */
    public function show(Pins $pins): Response
    {
        return $this->render('home/show.index.twig', compact('pins'));
    }
}
