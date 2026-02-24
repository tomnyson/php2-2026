<?php
class Cart extends Model
{
    private $table = "carts";
    public function all()
    {
       $sql = "SELECT ca.*, c.name AS colorName, s.name AS sizeName 
        FROM {$this->table} ca 
        LEFT JOIN variant v ON ca.variantId = v.id
        LEFT JOIN colors c ON v.colorId = c.id 
        LEFT JOIN sizes s ON v.sizeId = s.id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

      public function getCartByUserId($userId)
    {
       $sql = "SELECT ca.*, c.name AS colorName, s.name AS sizeName 
        FROM {$this->table} ca 
        LEFT JOIN variant v ON ca.variantId = v.id
        LEFT JOIN colors c ON v.colorId = c.id 
        LEFT JOIN sizes s ON v.sizeId = s.id where ca.userId = :userId";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'userId' => (int)$userId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

     public function getCartItemByUserId($variantId, $userId)
    {
       $sql = "SELECT * from carts where variantId = :variantId and userId = :userId ";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'userId' => (int)$userId,
            'variantId' => (int)$variantId
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function find($id)
    {
        $sql = "select * from $this->table where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByProductId($productId)
    {
       $sql = "SELECT v.*, c.name AS colorName, s.name AS sizeName 
        FROM {$this->table} v  
        LEFT JOIN colors c ON v.colorId = c.id 
        LEFT JOIN sizes s ON v.sizeId = s.id where v.productId = :productId";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
             'productId' => $productId
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data = [])
    {
        $sql = "insert into $this->table (userId, variantId, quantity) VALUES (:userId, :variantId, :quantity)";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'userId' => $data['userId'],
            'variantId' => $data['variantId'],
            'quantity' => $data['quantity'],
        ]);
    }

    public function update($data = [], $id)
    {
        $sql = "update $this->table set quantity = :quantity where id=:id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'quantity' => (int)$data['quantity'],
            'id' => (int)$id,
        ]);
    }

    public function delete($id)
    {
        $sql = "delete from $this->table where id = :id";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        return $stmt->execute([
            'id' => $id
        ]);
    }
    public function KTTonTai($productId, $sizeId, $colorId)
    {
        $sql = "select *  FROM `{$this->table}` where productId = :productId and sizeId = :sizeId and colorId = :colorId limit 1";
        $conn = $this->connect();
        $stmt =  $conn->prepare($sql);
        $stmt->execute([
            'productId' => (int)$productId,
            'sizeId' => (int)$sizeId,
            'colorId' => (int)$colorId
        ]);
        return  (bool)$stmt->fetchColumn();

        
    }
}
