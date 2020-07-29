<?php

namespace App\Controller;

use App\Repository\PinsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(PinsRepository $pins): Response
    {
        $pin = $pins->findAll();
        return $this->render('home/index.html.twig', compact('pin'));
    }
}
