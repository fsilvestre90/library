<?php
    /**
    *@backupGlobals disabled
    *@backupStaticAttributes disabled
    */

    require_once "src/Book.php";
    require_once "src/Author.php";
    require_once "src/Patron.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Author::deleteAll();
            Book::deleteAll();
            Patron::deleteAll();
            // Checkout::deleteAll();
        }

        function testSetPatronName()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);

            $new_patron->setPatronName("Aladdin");
            $result = $new_patron->getPatronName();

            $this->assertEquals("Aladdin", $result);
        }

        function testGetPatronName()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);

            $result = $new_patron->getPatronName();

            $this->assertEquals("Jasmine", $result);
        }

        function testGetId()
        {
            $patron_name = "Jasmine";
            $id = 1;
            $new_patron = new Patron($patron_name, $id);

            $result = $new_patron->getId();

            $this->assertEquals(1, $result);
        }

        function testSave()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);

            $new_patron->save();
            $result = Patron::getAll();

            $this->assertEquals($new_patron, $result[0]);

        }

        function testGetAll()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);
            $new_patron->save();

            $patron_name = "Aladin";
            $new_patron2 = new Patron($patron_name);
            $new_patron2->save();

            $result = Patron::getAll();

            $this->assertEquals([$new_patron, $new_patron2], $result);
        }

        function testUpdate()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);
            $new_patron->save();
            $new_patron->setPatronName("Jafar");
            $new_patron->update();

            $result = Patron::getAll();

            $this->assertEquals($new_patron, $result[0]);
        }

        function testSearch()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);
            $new_patron->save();

            $patron_name = "Aladin";
            $new_patron2 = new Patron($patron_name);
            $new_patron2->save();

            $result = Patron::find($new_patron2->getId());

            $this->assertEquals($new_patron2, $result);
        }

        function testDeleteOne()
        {
            $patron_name = "Jasmine";
            $new_patron = new Patron($patron_name);
            $new_patron->save();

            $patron_name = "Aladdin";
            $new_patron2 = new Patron($patron_name);
            $new_patron2->save();

            $new_patron->deleteOne();

            $result = Patron::getAll();

            $this->assertEquals($new_patron2, $result[0]);
        }

        function testFind()
        {
            $patron_name = "Jasmine";
            $id = 1;
            $new_patron = new Patron($patron_name, $id);
            $new_patron->save();

            $patron_name = "Aladdin";
            $new_patron2 = new Patron($patron_name);
            $new_patron2->save();

            $result = Patron::find($new_patron->getId());

            $this->assertEquals($new_patron, $result);

        }
    }

?>
