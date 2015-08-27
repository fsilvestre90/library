<?php
    class Patron
    {
        private $id;
        private $patron_name;

        function __construct($patron_name, $id = null)
        {
            $this->id = $id;
            $this->patron_name = $patron_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getPatronName()
        {
            return $this->patron_name;
        }

        function setId($newId)
        {
            $this->id = $newId;
        }

        function setPatronName($newPatronName)
        {
            $this->patron_name = $newPatronName;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO patrons (patron_name) VALUES ('{$this->getPatronName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $patrons_returned = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($patrons_returned as $patron){
                $id = $patron['id'];
                $patron_name = $patron['patron_name'];
                $new_patron = new Patron($patron_name, $id);
                array_push($patrons, $new_patron);
            }
            return $patrons;
        }

        static function find($searchId)
        {
            $patrons_returned = Patron::getAll();
            foreach($patrons_returned as $patron){
                if ($searchId == $patron->getId()){
                    return $patron;
                }
            }
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons;");
        }

        function update()
        {
            $GLOBALS['DB']->exec("UPDATE patrons SET patron_name = '{$this->getPatronName()}' WHERE id = {$this->getId()};");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons WHERE id = {$this->getId()};");
        }
    }
?>
