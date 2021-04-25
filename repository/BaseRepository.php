<?php
    class BaseRepository  {
        protected $mysqli;

        public function __construct($mysqli) {
            $this->mysqli = $mysqli;
        }

        // function __destruct() {
        //     if ($this->mysqli != null) {
        //         $this->mysqli->close();
        //     }
        // }
    }
?>