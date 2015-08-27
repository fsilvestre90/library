<?php
    Class Copies
    {

        static function setCopies($book, $quantity)
        {
            for($i = $quantity; 0 < $i; $i--)
            {
                $GLOBALS['DB']->exec("INSERT INTO copies (book_id) VALUES ({$book->getId()});");

            }
        }

        static function getCopies($book)
        {
            $returned_copies = $GLOBALS['DB']->query("SELECT SUM(id) AS NumberOfCopies FROM copies WHERE book_id = {$book->getId()};");
            foreach($returned_copies as $copy) {
                return count($copy);
            }

        }

        static function deleteAll()
        {
            $GLOBALS['db']->exec("DELETE FROM copies;");
        }
    }
?>
