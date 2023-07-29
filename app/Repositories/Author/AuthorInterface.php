<?php
namespace App\Repositories\Author;
interface AuthorInterface
{
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function find(int $id);
    public function getAll();
}
