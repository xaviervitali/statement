<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SkillsController extends AbstractController
{
    #[Route('/skills', name: 'app_skills')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('skills/index.html.twig', [
            "categories" => $categoryRepository->findBy([], ["title" => "ASC"])
        ]);
    }
}
