<?php

    class Author {

        private $id;
        private $author_name;

        function __construct($author_name, $id = null)
        {
            $this->id = $id;
            $this->author_name = $author_name;
        }

        function getAuthorId()
        {
            return $this->id;
        }

        function getAuthorName()
        {
            return $this->author_name;
        }

        function setAuthorId($newId)
        {
            $this->id = $newId;
        }

        function setAuthorName($newName)
        {
            $this->author_name = $newName;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO authors (author_name) VALUES ('{$this->getAuthorName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_authors = $GLOBALS['DB']->query("SELECT * FROM authors;");
            $authors = array();
            foreach($returned_authors as $author){
                $id = $author['id'];
                $author_name = $author['author_name'];
                $new_author = new Author($author_name, $id);
                array_push($authors, $new_author);
            }
            return $authors;
        }

        static function find($searchId)
        {

        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors;");
        }

        static function update($newAuthorName)
        {

        }

        function deleteOne($searchId)
        {

        }

    }


 ?>
