<?php
    Class Copies
    {
        private $id;
        private $book_id;
    }

    function __construct ($book_id, $id = null)
    {
        $this->id = $id;
        $this->book_id = $book_id;
    }

    function getBookId(){
        return $this->book_id;
    }

    function getId()
    {
        return $this->id;
    }

    function setId($new_id)
    {
        $this->id = $new_id;
    }

    function getCopies()
    {
        $returned_copies = $GLOBALS['DB']->query("SELECT SUM(book_id) AS NumberOfCopies FROM copies WHERE book_id = {$this->getBookId()};");

        var_dump($returned_copies);
    }

    function setCopies($book, $quantity)
    {
        for($i = $quantity; 0 < $i; $i--)
        {
            $GLOBALS['DB']->exec("INSERT INTO copies (book_id) VALUES ({$this->getBookId()});");
        }
    }
?>
