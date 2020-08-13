<?php 
declare(strict_types=1);



namespace App\Controller\Admin;

use App\Entity\Pins;
use App\Form\PinType;
use App\Repository\PinsRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/pins")
 * @package App\Controller\Admin
 * @author scotttresor <scotttresor@gmail.com>
 */
class AdminController extends AbstractController
{
    /**
     * @Route("", name="admin_page", methods="GET")
     * @param PinsRepository $pins
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */
    public function index(PinsRepository $pins): Response
    {
        return $this->render('admins/pins/index.html.twig', [
            'pins' => $pins->findAll()
        ]);
    }

    /**
     * @Route("/edit", name="admin_edit", methods="GET|POST")
     * @param Pins $pins
     * @return Response
     * @author scotttresor <scotttresor@gmail.com>
     */

    public function edit(Pins $pins): Response
    {
        return $this->render('admins/pins/edit.html.twig');
    }
}