<?php

namespace App\Controller;

use App\Entity\Commissaire;
use App\Form\CommissaireType;
use App\Repository\CommissaireRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/commissaire")
 */
class CommissaireController extends AbstractController
{
    /**
     * @Route("/", name="commissaire_index", methods={"GET"})
     */
    public function index(CommissaireRepository $commissaireRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('commissaire/index.html.twig', [
            'commissaires' => $commissaireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="commissaire_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $commissaire = new Commissaire();
        $form = $this->createForm(CommissaireType::class, $commissaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($commissaire);
            $entityManager->flush();

            return $this->redirectToRoute('commissaire_index');
        }

        return $this->render('commissaire/new.html.twig', [
            'commissaire' => $commissaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commissaire_show", methods={"GET"})
     */
    public function show(Commissaire $commissaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        return $this->render('commissaire/show.html.twig', [
            'commissaire' => $commissaire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="commissaire_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Commissaire $commissaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(CommissaireType::class, $commissaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('commissaire_index');
        }

        return $this->render('commissaire/edit.html.twig', [
            'commissaire' => $commissaire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="commissaire_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Commissaire $commissaire): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if ($this->isCsrfTokenValid('delete'.$commissaire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($commissaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('commissaire_index');
    }
}
