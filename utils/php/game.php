<?php
    class Game {
        var $id;
        var $name;
        var $console;
        var $qty;
        var $price;

        function __construct($id, $name, $console, $qty, $price) {
            $this->id = $id;
            $this->name = $name;
            $this->console = $console;
            $this->qty = $qty;
            $this->price = $price;
        }

        function get_id() {
            return $this->id;
        }

        function get_name() {
            return $this->name;
        }

        function get_console() {
            return $this->console;
        }

        function get_price() {
            return $this->price;
        }

        function get_qty() {
            return $this->qty;
        }
    }
?>