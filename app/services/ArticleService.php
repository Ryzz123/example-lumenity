<?php

namespace Lumenity\Framework\app\services;

use Exception;
use Lumenity\Framework\app\models\Article;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

class ArticleService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Capsule::connection()->getPdo();
    }

    public function findAll(): array
    {
        $articles = Article::with('category')->get();
        return $articles->map(function ($article) {
            return [
                'id' => $article->id,
                'title' => $article->title,
                'content' => $article->content,
                'category' => $article->category->name,
                'created_at' => $article->created_at,
                'updated_at' => $article->updated_at
            ];
        })->toArray();
    }


    public function findById(int $id): ?object
    {
        return Article::find($id);
    }

    public function findByCategoryId(int $categoryId): array
    {
        $articles = Article::where('category_id', $categoryId)->get();
        return $articles->toArray();
    }

    /**
     * @throws Exception
     */
    public function save(object $data): object
    {
        try {
            $this->connection->beginTransaction();
            $article = new Article();
            $article->title = $data->title;
            $article->content = $data->content;
            $article->category_id = $data->category_id;
            $article->save();

            $this->connection->commit();
            return $article;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function update(object $data): object
    {
        try {
            $this->connection->beginTransaction();
            $article = $this->findById($data->id);
            if (!$article) {
                throw new Exception('Article not found');
            }

            $article->title = $data->title;
            $article->content = $data->content;
            $article->category_id = $data->category_id;
            $article->save();

            $this->connection->commit();
            return $article;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function delete(int $id): void
    {
        try {
            $this->connection->beginTransaction();
            $article = $this->findById($id);
            if (!$article) {
                throw new Exception('Article not found');
            }

            $article->delete();

            $this->connection->commit();
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
}