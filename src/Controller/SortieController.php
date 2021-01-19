<?php

namespace App\Controller;


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
        $sorties = $repository->findAll();
        $user = $this->getUser();

        $form = $this->createForm(SearchSortieType::class);
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

//    public function search(Request $request)
//    {
//        $form = $this->createForm(SearchSortieType::class);
//        $form->handleRequest($request);
//
//        return $this->render('sorties/sorties.html.twig', [
//            'form'=> $form->createView()
//        ]);
//    }

//    public function search(Request $request)
//    {
//        $user = $this->getUser();
////        $data = new SearchSortie();
////        $form = $this->createForm(SearchSortieType::class, $data);
////        $form->handleRequest($request);
////        if($form->isSubmitted() && $form->isValid()) {
////            $manager = $this->getDoctrine()->getManager();
////            $sorties = $manager->getRepository(Sortie::class)->findSearch($this->getUser(), $data);
////        } else {
////            $sorties = $manager->getRepository(Sortie::class)->findAll();
////       }
//
//        return $this->render('sorties/sorties.html.twig', [
////            'sorties' => $sorties,
////            'form'=>$form->createView(),
//            'user'=>$user
//        ]);
//    }
}
