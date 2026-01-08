<?php
declare(strict_types=1);

class Product extends Model
{
    public function all(): array
    {
        $stmt = $this->db()->query('SELECT id, name, price FROM products ORDER BY id');
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array
    {
        $stmt = $this->db()->prepare('SELECT id, name, price FROM products WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch();
        return $row === false ? null : $row;
    }

    public function create(array $data): int
    {
        $stmt = $this->db()->prepare('INSERT INTO products (name, price) VALUES (:name, :price)');
        $stmt->execute([
            'name' => $data['name'],
            'price' => $data['price'],
        ]);

        return (int) $this->db()->lastInsertId();
    }

    public function update(int $id, array $data): bool
    {
        $stmt = $this->db()->prepare('UPDATE products SET name = :name, price = :price WHERE id = :id');
        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'price' => $data['price'],
        ]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db()->prepare('DELETE FROM products WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
