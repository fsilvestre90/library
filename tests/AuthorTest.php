<?php

    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Author.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            // Book::deleteAll();
            // Patron::deleteAll();
            // Checkout::deleteAll();
        }

        function testSetAuthorName()
        {
            $author_name = "Murakami";
            $test_author = new Author($author_name);

            $test_author->setAuthorName("Hemingway");
            $result = $test_author->getAuthorName();

            $this->assertEquals("Hemingway", $result);
        }

        function testGetAuthorName()
        {
            $author_name = "Murakami";
            $test_author = new Author($author_name);

            $result = $test_author->getAuthorName();
            $this->assertEquals($author_name, $result);
        }

        function testGetAuthorId()
        {
            $author_name = "Murakami";
            $id = 100;
            $test_author = new Author($author_name, $id);

            $result = $test_author->GetAuthorId();

            $this->assertEquals(100, $result);
        }

        function testSave()
        {
            $author_name = "Murakami";
            $test_author = new Author($author_name);
            $test_author->save();

            $result = Author::getAll();

            $this->assertEquals($test_author, $result[0]);
        }

        function testGetAll()
        {
            $author_name = "Murakami";
            $id = 1;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name = "Linux";
            $test_author2 = new Author($author_name);
            $test_author2->save();

            $result = Author::getAll();

            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function testDeleteAll()
        {
            $author_name = "Murakami";
            $id = 1;
            $test_author = new Author($author_name, $id);
            $test_author->save();

            $author_name = "Linux";
            $test_author2 = new Author($author_name);
            $test_author2->save();

            Author::deleteAll();
            $result = Author::getAll();

            $this->assertEquals([], $result);
        }
    }


 ?>
