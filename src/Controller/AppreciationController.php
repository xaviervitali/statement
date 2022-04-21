<?php

namespace App\Controller;

use App\Entity\Appreciation;
use App\Entity\User;
use App\Form\AppreciationsType;
use App\Form\AppreciationType;
use App\Repository\AppreciationRepository;
use App\Repository\CategorieRepository;
use App\Repository\CompetenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/appreciation')]
class AppreciationController extends AbstractController
{
    #[Route('/{id<\d+>}', name: 'app_appreciation_index', methods: ['GET'])]
    public function index(AppreciationRepository $appreciationRepository, User $user): Response
    {
        return $this->render('appreciation/index.html.twig', [
            'appreciations' => $appreciationRepository->findBy(["user" => $user], ["ajouteLe" => "DESC"]), "user" => $user
        ]);
    }

    #[Route('/{id<\d+>}/new', name: 'app_appreciation_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  User $user): Response
    {
        $appreciation = new Appreciation();


        // $form = $this->createForm(AppreciationType::class, $appreciation);
        // $form->handleRequest($request);

        // if ($form->isSubmitted() && $form->isValid()) {
        //     $appreciationRepository->add($appreciation);
        //     return $this->redirectToRoute('app_appreciation_index', [], Response::HTTP_SEE_OTHER);
        // }
        $form = $this->createForm(AppreciationsType::class);
        return $this->render('appreciation/new.html.twig', [
            "user" => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_appreciation_show', methods: ['GET'])]
    public function show(Appreciation $appreciation): Response
    {
        return $this->render('appreciation/show.html.twig', [
            'appreciation' => $appreciation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_appreciation_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Appreciation $appreciation, AppreciationRepository $appreciationRepository): Response
    {
        $form = $this->createForm(AppreciationType::class, $appreciation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $appreciationRepository->add($appreciation);
            return $this->redirectToRoute('app_appreciation_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('appreciation/edit.html.twig', [
            'appreciation' => $appreciation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_appreciation_delete', methods: ['POST'])]
    public function delete(Request $request, Appreciation $appreciation, AppreciationRepository $appreciationRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $appreciation->getId(), $request->request->get('_token'))) {
            $appreciationRepository->remove($appreciation);
        }

        return $this->redirectToRoute('app_appreciation_index', [], Response::HTTP_SEE_OTHER);
    }
}
