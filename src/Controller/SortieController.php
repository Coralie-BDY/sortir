<?php

namespace App\Controller;

use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @param \App\Repository\SortieRepository $repository
     * @Route("/home", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SortieRepository $repository): Response
    {
        $sorties = $repository->findSearch();
        $user = $this->getUser();
        return $this->render('sorties/sorties.html.twig', [
            'sorties' => $sorties,
            'user'=>$user
        ]);
    }
}
