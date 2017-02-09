<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    session_start();

    if (empty($_SESSION['list_of_cars'])) {
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    $app['debug'] = true;

    $app->get('/', function() use ($app) {
        return $app['twig']->render('input.html.twig');
    });

    $app->post('/add_car', function() use ($app) {
        $my_car = new Car($_POST['set_make_model'], $_POST['set_price'], $_POST['set_miles'], $_POST['set_style']);
        $my_car->save();
        return $app['twig']->render('add_car.html.twig', array('new_cars' => $my_car));
    });

    $app->get('/output', function() use ($app) {
        $price = $_GET['price'];
        $miles = $_GET['mileage'];
        return $app['twig']->render('output.html.twig', array('search_cars' => Car::search($price, $miles)));
    });

    $app->post('/delete_car', function() use ($app) {
        return $app['twig']->render('input.html.twig', array('delete' => Car::deleteAll()));
    });

    return $app;
?>
