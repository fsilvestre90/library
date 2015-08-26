<?php
    class Book
    {
        private $id;
        private $title;

        function __construct($title, $id = null)
        {
            $this->id = $id;
            $this->title = $title;
        }

        function getId()
        {
            return $this->id;
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
            $GLOBALS['DB']->exec("INSERT INTO books (title) VALUES ('{$this->getTitle()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $result_books = $GLOBALS['DB']->query("SELECT * FROM books;");

            $all_books = array();
            foreach($result_books as $book) {
                $id = $book['id'];
                $title = $book['title'];
                $new_book = new Book($title, $id);
                array_push($all_books, $new_book);
            }
            return $all_books;
        }

        static function find($searchId)
        {
            $books = Book::getAll();
            foreach($books as $book){
                if($searchId = $book->getId()){
                    return $book;
                }
            }
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM books;");
        }

        function update()
        {
            $GLOBALS['DB']->exec("UPDATE books SET title = '{$this->getTitle()}' WHERE id = {$this->getId()};");
        }

        function deleteOne()
        {
            $GLOBALS['DB']->exec("DELETE FROM books WHERE id = {$this->getId()};");
        }
    }
?>
