<?php
    class Patron
    {
        private $patron_id;
        private $patron_name;

        function __construct($patron_id, $patron_name)
        {
            $this->patron_id = $patron_id;
            $this->patron_name = $patron_name;
        }

        function getPatronId()
        {
            return $this->patron_id;
        }

        function getPatronName()
        {
            return $this->patron_name;
        }

        function setPatronId($newId)
        {
            $this->patron_id = $newId;
        }

        function setPatronName($newPatronName)
        {
            $this->patron_name = $newPatronName;
        }

        function save()
        {

        }

        static function getAll()
        {

        }

        static function find($searchId)
        {

        }

        static function deleteAll()
        {

        }

        static function update()
        {

        }

        function deleteOne($searchId)
        {

        }
    }
?>
