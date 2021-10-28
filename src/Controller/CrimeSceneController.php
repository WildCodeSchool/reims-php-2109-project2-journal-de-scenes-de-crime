<?php

namespace App\Controller;

use App\Model\CrimeSceneManager;

class CrimeSceneController extends AbstractController
{
    public function index(): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $titles = $crimeSceneManager->selectAll();

        return $this->twig->render('Home/index.html.twig', ['titles' => $titles]);
    }
}
