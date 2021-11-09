<?php

namespace App\Controller;

use App\Model\CrimeSceneManager;
use App\Model\CommentManager;

class CrimeSceneController extends AbstractController
{
    public function index(): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $titles = $crimeSceneManager->selectAll();

        return $this->twig->render('Crime/index.html.twig', ['titles' => $titles]);
    }

    public function add(): string
    {
        $crimeSceneManager = new CrimeSceneManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $crimeScene = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, insert and redirection
            $id = $crimeSceneManager->insert($crimeScene);
            header('Location:/crimes/show?id=' . $id);
        }

        return $this->twig->render('Crime/createCrime.html.twig');
    }

    public function show(int $id): string
    {
        // si je fais une requête de type POST

        $crimeSceneManager = new CrimeSceneManager();
        $crimeScene = $crimeSceneManager->selectOneById($id);

        $commentManager = new CommentManager();
        $newComment = $commentManager->selectAllByCrimeSceneId($id);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $newComment = array_map('trim', $_POST);
            // créer un commentaire associé à $id
            $newComment['crimescene_id'] = $id;
            $id = $commentManager->insert($newComment);
        }

        return $this->twig->render('Crime/showCrime.html.twig', ['crimeScene' => $crimeScene]);
    }

    public function edit(int $id): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $crimeScene = $crimeSceneManager->selectOneById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $crimeScene = array_map('trim', $_POST);

            // TODO validations (length, format...)

            // if validation is ok, update and redirection
            $crimeSceneManager->update($crimeScene);
            header('Location:/crimes/show?id=' . $id);
        }

        return $this->twig->render('Crime/editCrime.html.twig', [
            'crimeScene' => $crimeScene,
        ]);
    }
}
