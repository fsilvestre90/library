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

        function addAuthor($author)
        {
            $GLOBALS['DB']->exec("INSERT INTO authors_books (author_id, book_id) VALUES ({$author->getId()}, {$this->getId()});");
            var_dump($author->getId());
        }

        function getAuthors()
        {
           $returned_authors = $GLOBALS['DB']->query("SELECT authors.* FROM authors
                                                JOIN authors_books on (authors.id = authors_books.author_id)
                                                JOIN books on (books.id = authors_books.book_id)
                                            WHERE books.id = {$this->getId()};");
           $authors = array();
           foreach($returned_authors as $author)
           {
               $id = $author['id'];
               $author_name = $author['author_name'];
               $new_author = new Author($author_name, $id);
               array_push($authors, $new_author);
           }
           var_dump($authors);
           return $authors;
        }


    }
?>
