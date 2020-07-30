<?php

namespace App\Controller;

use App\Entity\Pins;
use App\Form\PinType;
use App\Repository\PinsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home", methods="GET")
     * @param PinsRepository $pins
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function index(PinsRepository $pins): Response
    {
        $pin = $pins->findBy([], ['createdAt' => 'DESC']);
        return $this->render('home/index.html.twig', compact('pin'));
    }

    /**
     * @Route("/pins/create", name="create", methods="GET|POST")
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PinType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pin = $form->getData();
            $em->persist($pin);
            $em->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('home/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}", name="detail", methods="GET")
     * @param Pins $pins
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function show(Pins $pins): Response
    {
        return $this->render('home/show.index.twig', compact('pins'));
    }

    /**
     * @Route("/pins/{id<[0-9]+>}/edit", name="edit", methods="GET|PUT")
     * @param Pins $pins
     * @param Request $request
     * @param EntityManagerInterface $em
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function edit(Pins $pins, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(PinType::class, $pins,['method'=> 'PUT']);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pin = $form->getData();
            $em->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('home/edit.index.twig',[
            'pins' => $pins,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/pins/{id<[0-9]+>}/delete", name="delete")
     * @param Pins $pins
     * @param EntityManagerInterface $em
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function delete(Request $request, Pins $pins, EntityManagerInterface $em): Response
    {
        if (
            $this->isCsrfTokenValid(
                'supprimer_' . $pins->getId(),
                $request->request->get('csrf_token')
            ))
        {
            $em->remove($pins);
            $em->flush();
        }
        return $this->redirectToRoute('home');
    }
}
