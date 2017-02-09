<?php
class Car
{
    private $make_model;
    private $price;
    private $miles;
    private $style;
    private $picture;

    function __construct($make_model, $price, $miles, $style)
    {
        $this->make_model = $make_model;
        $this->price = $price;
        $this->miles = $miles;
        $this->style = $style;
    }

    function setMakeModel($new_make_model)
    {
        $this->make_model = $new_make_model;

    }

    function setPrice($new_price)
    {
        $this->price = $new_price;
        return $new_price;
    }

    function setMiles($new_miles)
    {
        $this->miles = $new_miles;
        return $new_miles;
    }

    function setStyle($new_style)
    {
        $this->style = $new_style;
        return $new_miles;
    }

    function setPicture($new_picture)
    {
        $this->picture = $new_picture;
    }

    function getMakeModel()
    {
        return $this->make_model;
    }
    function getPrice()
    {
        return $this->price;
    }
    function getMiles()
    {
        return $this->miles;
    }
    function getStyle()
    {
        return $this->style;
    }
    function getPicture()
    {
        return $this->picture;
    }

    function worthBuying($max_price, $max_mileage)
    {
        if($max_price >= $this->price && $max_mileage >= $this->miles)
        return $this->price && $this->miles;
    }

    function save()
    {
        array_push($_SESSION['list_of_cars'], $this);
    }

    // static function getAll()
    // {
    //     return $_SESSION['list_of_cars'];
    // }

}
?>
