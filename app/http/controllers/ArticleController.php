<?php

namespace Lumenity\Framework\app\http\controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lumenity\Framework\app\services\ArticleService;

class ArticleController
{
    private ArticleService $articleService;

    public function __construct()
    {
        $this->articleService = new ArticleService();
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return void
     */
    public function getAll(Request $req, Response $res): void
    {
        try {
            $articles = $this->articleService->findAll();
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($articles));
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * @param string $id
     * @return void
     */
    public function getById(Request $req, Response $res, string $id): void
    {
        try {
            $article = $this->articleService->findById($id);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($article));
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * @param string $categoryId
     * @return void
     */
    public function getByCategoryId(Request $req, Response $res, string $categoryId): void
    {
        try {
            $articles = $this->articleService->findByCategoryId($categoryId);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($articles));
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return void
     */
    public function save(Request $req, Response $res): void
    {
        try {
            $data = (object)$req->all();
            $article = $this->articleService->save($data);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(201);
            $res->setContent(json_encode($article));
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * @param string $id
     * @return void
     */
    public function update(Request $req, Response $res, string $id): void
    {
        try {
            $data = (object)$req->all();
            $data->id = $id;
            $article = $this->articleService->update($data);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($article));
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * @param string $id
     * @return void
     */
    public function delete(Request $req, Response $res, string $id): void
    {
        try {
            $this->articleService->delete($id);
            $res->setStatusCode(204);
            $res->send();
        } catch (Exception $exception) {
            $res->setStatusCode(500);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => $exception->getMessage()
            ]));
            $res->send();
        }
    }
}