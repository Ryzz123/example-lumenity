<?php

namespace Lumenity\Framework\app\services;
use Exception;
use Lumenity\Framework\app\models\Category;
use Illuminate\Database\Capsule\Manager as Capsule;
use PDO;

class CategoryService
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Capsule::connection()->getPdo();
    }

    public function findAll(): array
    {
        $categories = Category::all();
        return $categories->toArray();
    }

    public function findById(int $id): ?object
    {
        return Category::find($id);
    }

    /**
     * @throws Exception
     */
    public function save(object $data): object
    {
        try {
            $this->connection->beginTransaction();
            $category = new Category();
            $category->name = $data->name;
            $category->description = $data->description;
            $category->save();

            $this->connection->commit();
            return $category;
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
            $category = $this->findById($data->id);
            if (!$category) {
                throw new Exception('Category not found');
            }

            $category->name = $data->name;
            $category->description = $data->description;
            $category->save();

            $this->connection->commit();
            return $category;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }

    /**
     * @throws Exception
     */
    public function delete(string $id): bool
    {
        try {
            $this->connection->beginTransaction();
            $category = $this->findById($id);
            if (!$category) {
                throw new Exception('Category not found');
            }

            $category->delete();
            $this->connection->commit();
            return true;
        } catch (Exception $exception) {
            $this->connection->rollBack();
            throw $exception;
        }
    }
}