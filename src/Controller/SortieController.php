<?php

namespace App\Controller;



use App\Entity\SearchSortie;
use App\Form\SearchSortieType;
use App\Repository\SortieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     *
     * @Route("/home", name="home")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(SortieRepository $repository, Request $request): Response
    {
        $data = new SearchSortie();
        $user = $this->getUser();
        $data->setCampus($user->getCampus());
        $sorties = $repository->findByCampus($data, $user);

        $form = $this->createForm(SearchSortieType::class, $data);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $sorties =$repository->findSearch($data, $user);

        }
        return $this->render('sorties/sorties.html.twig', [
            'sorties' => $sorties,
            'user'=>$user,
            'form'=> $form->createView()
        ]);
    }



}
