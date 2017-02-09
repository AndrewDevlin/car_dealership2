<?php
    date_default_timezone_set("America/Los_Angeles");
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Car.php";

    // $app ['debug'] = True;

    session_start();

    if (empty($_SESSION['list_of_cars'])) {
        $_SESSION['list_of_cars'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));



    $app->get('/', function() use ($app) {
        return $app['twig']->render('input.html.twig');
    });

    $app->get('/search', function() use ($app) {
        $porsche = new Car("2014 Porsche 911", 114991, 7864, "Sedan", "img/porsche.jpg");
        $ford = new Car("2011 Ford F450", 55995, 14241, "Coupe", "img/ford.jpg");
        $lexus = new Car("2013 Lexus RX 350", 44700, 20000, "Sedan", "img/lexus.jpg");
        $mercedes = new Car("Mercedes Benz CLS550", 39900, 37979, "Coupe", "img/benz.jpg");

        $cars = array($porsche, $ford, $lexus, $mercedes);
        $cars_matching_search = array();
        foreach ($cars as $car) {
            if ($car->worthBuying($_GET['price'], $_GET['mileage'])) {
                array_push($cars_matching_search, $car);
            }
        }

        return $app['twig']->render('output.html.twig');
    });

    $app->post('/add_car', function() use ($app) {
        $my_car = new Car($_POST['set_make_model'], $_POST['set_price'], $_POST['set_miles'], $_POST['set_style']);
        $my_car->save();

        return $app['twig']->render('add_car.html.twig', array('new_cars' => $my_car));
    });

    // $app->post('/search', function() use ($app) {
    //     return $app['twig']->render('output.html.twig', array())
    // })



    return $app;
?>
