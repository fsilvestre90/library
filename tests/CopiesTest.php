<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Book.php";
    require_once "src/Author.php";
    require_once "src/Copies.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CopiesTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
            Patron::deleteAll();
            Copies::deleteAll();
        }

        function testAddCopy()
        {
            $book_name = "Marakami";
            $new_book = new Book($book_name);
            $new_book->save();

            Copies::setCopies($new_book, 5);

            $result = Copies::getCopies($new_book);

            $this->assertEquals(5, $result);
        }

        function testRemoveCopies()
        {
            $book_name = "Marakami";
            $new_book = new Book($book_name);
            $new_book->save();

            Copies::setCopies($new_book, 8);

            Copies::removeCopies($new_book, 5);

            $result = Copies::getCopies($new_book);

            $this->assertEquals(3, $result);
        }
    }
?>
