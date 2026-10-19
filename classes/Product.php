<?php
declare(strict_types=1);

// Week 7 style: the ID comes from a static counter that PHP forgets
// every time the script ends. Step 5 changes this.
class Product
{


   public ?int $id;          // null until the product is saved in the database
    public string $code;
    public string $name;
    public string $description;
    private float $price;
    public int $categoryId;
    public string $category;

    public function __construct(
        string $code,
        string $name,
        string $description,
        float $price,
        int $categoryId,
        string $category,
        ?int $id = null
    ) {
        $this->id = $id;
        $this->code = $code;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->categoryId = $categoryId;
        $this->category = $category;
    }

    // Build a Product from one row of the products + categories SELECT.
    // Cousin of Week 7's fromCsvRow(): the class knows how a row is shaped.
    public static function fromRow(array $row): Product
    {
        return new Product(
            $row['productCode'],
            $row['productName'],
            $row['description'],
            (float) $row['listPrice'],
            (int) $row['categoryID'],
            $row['categoryName'],
            (int) $row['productID']
        );
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function formattedPrice(): string
    {
        return '$' . number_format($this->price, 2);
    }


}
