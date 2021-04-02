<?php

namespace App\Controller;

use App\Entity\Lot;
use App\Entity\Produit;
use App\Entity\User;
use App\Form\NewLotType;
use App\Form\ProduitType;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MeController extends AbstractController
{
    /**
     * @Route("/me", name="me")
     */
    public function index(): Response
    {
        return $this->render('me/index.html.twig', [
            'controller_name' => 'MeController',
        ]);
    }

    /**
     * @Route("/me/edit", name="me_edit", methods={"GET","POST"})
     */
    public function edit(Request $request): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_index');
        }

        return $this->render('me/profile_edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }





}
