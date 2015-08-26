<?php

    class Author {

        private $id;
        private $author_name;

        function __construct($author_name, $id = null)
        {
            $this->id = $id;
            $this->author_name = $author_name;
        }

        function getId()
        {
            return $this->id;
        }

        function getAuthorName()
        {
            return $this->author_name;
        }

        function setId($newId)
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
            $authors = Author::GetAll();
            foreach($authors as $author) {
                if ($searchId == $author->getId()) {
                    return $author;
                }
            }
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors;");
        }

        function update($newAuthorName)
        {
            $GLOBALS['DB']->exec("UPDATE authors SET author_name = $newAuthorName WHERE id = {$this->getId()};");
            var_dump($newAuthorName);
            $this->setAuthorName($newAuthorName);
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM authors WHERE id = {$this->getId()};");
        }

    }


 ?>
