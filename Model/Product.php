class Product {
    private $productId;
    private $productName;
    private $description;
    private $price;
    private $amount;
    private $category;
    private $image;

    public function __construct($productName, $description, $price, $amount, $category, $image) {
        $this->productName = $productName;
        $this->description = $description;
        $this->price = $price;
        $this->amount = $amount;
        $this->category = $category;
        $this->image = $image;
    }

    // Getters and Setters

    public function getProductId() {
        return $this->productId;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        $this->price = $price;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
