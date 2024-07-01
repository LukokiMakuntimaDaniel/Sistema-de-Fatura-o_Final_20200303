class Invoice {
    private $invoiceId;
    private $productId;
    private $amount;
    private $total;
    private $invoiceDate;

    public function __construct($productId, $amount, $total, $invoiceDate) {
        $this->productId = $productId;
        $this->amount = $amount;
        $this->total = $total;
        $this->invoiceDate = $invoiceDate;
    }

    // Getters and Setters

    public function getInvoiceId() {
        return $this->invoiceId;
    }

    public function getProductId() {
        return $this->productId;
    }

    public function setProductId($productId) {
        $this->productId = $productId;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getTotal() {
        return $this->total;
    }

    public function setTotal($total) {
        $this->total = $total;
    }

    public function getInvoiceDate() {
        return $this->invoiceDate;
    }

    public function setInvoiceDate($invoiceDate) {
        $this->invoiceDate = $invoiceDate;
    }
}
