<?php

namespace App\Controller;

use App\Model\CrimeSceneManager;
use App\Model\CommentManager;
use App\Model\CrimeSceneHashtagManager;
use App\Model\HashtagManager;

class CrimeSceneController extends AbstractController
{
    public function index(): string
    {
        return $this->twig->render('Crime/index.html.twig');
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
            $this->extractHashtags($id, $crimeScene['description']);
            header('Location:/crimes/show?id=' . $id);
        }

        return $this->twig->render('Crime/createCrime.html.twig');
    }

    private function extractHashtags(int $crimeSceneId, string $text)
    {
        $hashtagManager = new HashtagManager();
        $crimeSceneTagManager = new CrimeSceneHashtagManager();

        $matches = [];
        $keywords = [];
        preg_match_all("/(#[A-Za-z0-9\-]+)/u", $text, $matches);
        if ($matches) {
            $hashtagsArray = array_count_values($matches[0]);
            $keywords = array_keys($hashtagsArray);
        }

        foreach ($keywords as $keyword) {
            $keyword = substr($keyword, 1);
            $existingHashtag = $hashtagManager->selectOneByKeyword($keyword);
            if ($existingHashtag) {
                $hashtagId = $existingHashtag['id'];
            } else {
                $hashtagId = $hashtagManager->insert(['keyword' => $keyword]);
            }

            $crimeSceneTagManager->insert([
                'crimescene_id' => $crimeSceneId,
                'hashtag_id' => $hashtagId,
            ]);
        }
    }

    public function show(int $id): string
    {
        // si je fais une requête de type POST
        $commentManager = new CommentManager();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // clean $_POST data
            $newComment = array_map('trim', $_POST);
            // créer un commentaire associé à $id
            $newComment['crimescene_id'] = $id;
            $commentManager->insert($newComment);
            $this->extractHashtags($id, $newComment['message']);

            header('Location:/crimes/show?id=' . $id);
        }

        $crimeSceneManager = new CrimeSceneManager();
        $crimeScene = $crimeSceneManager->selectOneById($id);

        $crimeSceneComments = $commentManager->selectAllByCrimeSceneId($id);

        return $this->twig->render('Crime/showCrime.html.twig', [
            'crimeScene' => $crimeScene,
            'crimeSceneComments' => $crimeSceneComments,
        ]);
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

    public function search(string $query): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $titles = $crimeSceneManager->search($query);

        return $this->twig->render('Crime/searchResults.html.twig', ['titles' => $titles]);
    }
    public function listallcrimes(): string
    {
        $crimeSceneManager = new CrimeSceneManager();
        $titles = $crimeSceneManager->selectAll();

        return $this->twig->render('Crime/register.html.twig', ['titles' => $titles]);
    }
}
