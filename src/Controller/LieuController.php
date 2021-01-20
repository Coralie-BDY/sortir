<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Form\LieuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LieuController extends AbstractController
{
//    /**
//     * @Route("/lieu", name="lieu")
//     */
//    public function index(): Response
//    {
//        return $this->render('lieu/index.html.twig', [
//            'controller_name' => 'LieuController',
//        ]);
//    }

//    /**
//     * @Route("/create/lieu", name="lieu")
//     * @param \Symfony\Component\HttpFoundation\Request $request
//     *
//     * @return \Symfony\Component\HttpFoundation\Response
//     */
//    public function createLieu(Request $request): Response
//    {
//        $lieu= new Lieu();
//        $user = $this->getUser();
//        $form= $this->createForm(LieuType::class);
//        $form->handleRequest($request);
//
//        return $this->render('fiche/lieu.html.twig', [
//            'lieu' => $lieu,
//            'user' => $user,
//            'form' => $form->createView()
//        ]);
//    }

}
