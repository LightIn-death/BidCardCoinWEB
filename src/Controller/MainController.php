<?php

namespace App\Controller;

use App\Entity\Lot;
use App\Entity\Produit;
use App\Form\NewLotType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    /**
     * @Route("/", name="main")
     */
    public function index(): Response
    {

        $Products =  $this->getDoctrine()->getRepository(Produit::class)->findAll();



        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'products' => $Products
        ]);
    }


    /**
     * @Route("/new", name="me_add_object", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $lot = new Lot();



        $form = $this->createForm(NewLotType::class,$lot);



        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lot);
            $entityManager->flush();
            foreach ($lot->getProduits() as $produit){

                $produit->setVendeur( $this->getUser());
                $produit->setLot($this->getDoctrine()->getManager()->getRepository(Lot::class)->find($lot->getId()));
                $produit->setIsSend(false);
                $produit->setPhotoUrl("https://source.unsplash.com/1600x900/?technologie");
                $entityManager->persist($produit);
            }
            $entityManager->flush();

            return $this->redirectToRoute('produit_index');
        }

        return $this->render('main/new.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
