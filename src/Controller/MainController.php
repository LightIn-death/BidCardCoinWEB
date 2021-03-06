<?php

namespace App\Controller;

use App\Entity\Lot;
use App\Entity\OrdreAchat;
use App\Form\NewLotType;
use App\Form\NewOrderAchatType;
use DateTime;
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


        $LotsData = $this->getDoctrine()->getRepository(Lot::class)->findBy([], $orderBy = null, $limit = 10, $offset = 0);

        $Lots = [];
        /* @var $l Lot */
        foreach ($LotsData as $l) {
            if (!is_null($l->getVente())) {
                array_push($Lots, $l);
            }
        }

        if(!empty($Lots)) {
            $v = $Lots[0]->getVente();
        } else {
            $v = [];
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'Lots' => $Lots,
            'v' => $v
        ]);
    }

    /**
     * @Route("/page/{page}", name="main_page")
     */
    public function index_page($page): Response
    {


        $Lots = $this->getDoctrine()->getRepository(Lot::class)->findBy([], $orderBy = null, $limit = 10, $offset = $page * 10);


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'Lots' => $Lots
        ]);
    }


    /**
     * @Route("/new", name="me_add_object", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $lot = new Lot();


        $form = $this->createForm(NewLotType::class, $lot);


        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lot);
            foreach ($lot->getProduits() as $produit) {

                $produit->setVendeur($this->getUser());
                $produit->setLot($lot);
                $produit->setIsSend(false);
                $produit->setPhotoUrl("https://source.unsplash.com/1600x900/?technologie");
                $entityManager->persist($produit);
            }
            $entityManager->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('main/new.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/view/{id}", name="view_id", methods={"GET","POST"})
     */
    public function view($id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $Lot = $this->getDoctrine()->getRepository(Lot::class)->find($id);
        $OrdreAchat = $this->getDoctrine()->getRepository(OrdreAchat::class)->findby(
            [
                'Utilistateur' => $this->getUser(),
                'Lot' => $Lot
            ]
        );


        return $this->render('main/view.html.twig', [
            'lot' => $Lot,
            'oa' => $OrdreAchat,
        ]);
    }


    /**
     * @Route("/view/{id}/new", name="new_view", methods={"GET","POST"})
     */
    public function new_view(Request $request, $id): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $Lot = $this->getDoctrine()->getRepository(Lot::class)->find($id);

        $ordreAchat = new OrdreAchat();
        $form = $this->createForm(NewOrderAchatType::class, $ordreAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();

            $ordreAchat->setLot($Lot);
            $ordreAchat->setAutomatique(true);
            $ordreAchat->setDate(new DateTime('NOW'));
            $ordreAchat->setUtilistateur($this->getUser());
            $entityManager->persist($ordreAchat);
            $entityManager->flush();

            return $this->redirectToRoute('view_id', ["id" => $id]);
        }


        return $this->render('main/view_new.html.twig', [
            'ordre_achat' => $ordreAchat,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/view/{id}/edit", name="modify_view", methods={"GET","POST"})
     */
    public function modify_view(Request $request, OrdreAchat $ordreAchat): Response
    {


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');


        $form = $this->createForm(NewOrderAchatType::class, $ordreAchat);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('main');
        }

        return $this->render('ordre_achat/edit.html.twig', [
            'ordre_achat' => $ordreAchat,
            'form' => $form->createView(),
        ]);
    }


}
