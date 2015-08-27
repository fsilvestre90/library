<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Book.php";
    require_once __DIR__."/../src/Author.php";
    require_once __DIR__."/../src/Patron.php";
    require_once __DIR__."/../src/Copies.php";

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    //Debugger
    //add symfony debug component
    use Symfony\Component\Debug\Debug;
    Debug::enable();

    $app = new Silex\Application();

    $app['debug'] = true;

    $server = 'mysql:host=localhost;dbname=library';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../views'));

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array('books' => Book::getAll()));
    });

    $app->get("/books", function() use ($app) {
        return $app['twig']->render('books.html.twig', array('books' => Book::getAll()));
    });

    // $app->get("/authors", function() use ($app) {
    //     return $app['twig']->render('books.html.twig', array('authors' => Author::getAll()));
    // });
    //
    $app->post("/books", function() use ($app) {
       $title = $_POST['title'];
       $Book = new Book($_POST['title']);
       $Book->save();
       $author_name = $_POST['author_name'];
       $Author = new Author($_POST['author_name']);
       $Author->save();
       $Book->addAuthor($Author);
       return $app['twig']->render('index.html.twig', array('books' => Book::getAll(), 'author' => $Book->getAuthors()));
   });

    return $app;
?>
