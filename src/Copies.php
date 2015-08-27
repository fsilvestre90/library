<?php
    Class Copies
    {

        static function setCopies($book, $quantity)
        {
            for($i = 1; $i <= $quantity; $i++)
            {
                $GLOBALS['DB']->exec("INSERT INTO copies (book_id, checked_out) VALUES ({$book->getId()}, 1);");
            }
        }

        static function checkOut($book, $patron)
        {
            //set the due date
            date_default_timezone_set('UTC');
            $due_date = new DateTime();
            $due_date->modify('+4 week');

            //first we need to insert a record of the book checked out by the person
            $GLOBALS['DB']->exec("INSERT INTO checkouts (patron_id, book_id, due_date) VALUES ({$patron->getId()}, {$book->getId()}), '{$due_date}';");
            //after we need to set the copy of the book to checked out
            $GLOBALS['DB']->exec("UPDATE copies SET checked_out = 0 WHERE book_id = {$book->getId()};");

        }

        static function returnedBook($book, $patron)
        {

        }

        static function getCopies($book)
        {
            $returned_copies = $GLOBALS['DB']->query("SELECT COUNT(id) AS NumberOfCopies FROM copies WHERE book_id = {$book->getId()};");
            $result = $returned_copies->fetch();

            return (int) $result['NumberOfCopies'];

        }

        static function removeCopies($book, $quantity_to_remove)
        {
            for($i = 1; $i <= $quantity; $i++) {
                $GLOBALS['DB']->exec("DELETE FROM copies id = 1 WHERE id = {$book->getId()}");
            }
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM copies;");
        }
    }
?>
