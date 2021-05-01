<?php
class Event {
    private $id;
    private $name;
    private $status;

    public function __construct($id, $name, $status) {
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
}
?>