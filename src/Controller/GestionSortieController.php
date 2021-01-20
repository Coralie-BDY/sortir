<?php

namespace App\Controller;

use App\Entity\Lieu;
use App\Entity\Sortie;
use App\Form\CreateType;
use App\Form\LieuType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GestionSortieController extends AbstractController
{

    /**
     * @Route("/create", name="create")
     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function createSortie(Request $request): Response
    {

        $sortie = new Sortie();

        $user = $this->getUser();
        $form = $this->createForm(CreateType::class);
        $form->handleRequest($request);

        return $this->render('fiche/create.html.twig', [
            'sorties' => $sortie,
            'user' => $user,
            'form' => $form->createView()
        ]);
    }


    /**

     * @param \Symfony\Component\HttpFoundation\Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function createLieu(Request $request): Response
    {
        $lieu= new Lieu();
        $user = $this->getUser();
        $form= $this->createForm(LieuType::class);
        $form->handleRequest($request);

        return $this->render('fiche/lieu.html.twig', [
            'lieu' => $lieu,
            'user' => $user,
            'form' => $form->createView()
        ]);
    }




}
