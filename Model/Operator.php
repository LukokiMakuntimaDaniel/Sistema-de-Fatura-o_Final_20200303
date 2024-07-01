
class Operator {
    private $operatorId;
    private $userId;

    public function __construct($userId) {
        $this->userId = $userId;
    }

    // Getters and Setters

    public function getOperatorId() {
        return $this->operatorId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }
}
