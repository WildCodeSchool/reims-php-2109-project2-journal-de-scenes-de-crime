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

    public function add(): string
    {
        $crimeSceneManager = new CrimeSceneManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $crimeScene = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $crimeSceneManager->insert($crimeScene);
        }

        return $this->twig->render('CreateCrime/CreateYourCrime.html.twig');
    }

    public function show(int $id): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $name = $crimeSceneManager->selectOneById($id);

        return $this->twig->render('ShowCrime/showCrimeScene.html.twig', ['name' => $name]);
    }
}
