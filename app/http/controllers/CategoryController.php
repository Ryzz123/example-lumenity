<?php

namespace Lumenity\Framework\app\http\controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Lumenity\Framework\app\services\CategoryService;

class CategoryController
{

    private CategoryService $categoryService;

    public function __construct()
    {
        $this->categoryService = new CategoryService();
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return void
     */
    public function getAll(Request $req, Response $res): void
    {
        try {
            $categories = $this->categoryService->findAll();
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($categories));
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
            $category = $this->categoryService->findById($id);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($category));
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
    public function create(Request $req, Response $res): void
    {
        try {
            $data = (object)$req->all();
            $category = $this->categoryService->save($data);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(201);
            $res->setContent(json_encode($category));
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
            $category = $this->categoryService->update($data);
            $res->headers->set('Content-Type', 'application/json');
            $res->setStatusCode(200);
            $res->setContent(json_encode($category));
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
            $this->categoryService->delete($id);
            $res->setStatusCode(200);
            $res->headers->set('Content-Type', 'application/json');
            $res->setContent(json_encode([
                'message' => 'Category deleted successfully'
            ]));
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