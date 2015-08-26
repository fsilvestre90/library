<?php
    class Book
    {
        private $book_id;
        private $title;

        function __construct($book_id, $title)
        {
            $this->book_id = $book_id;
            $this->title = $title;
        }

        function getBookId()
        {
            return $this->book_id;
        }

        function setTitle($new_title)
        {
            $this->title = (string) $new_title;
        }

        function getTitle()
        {
            return $this->title;
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
