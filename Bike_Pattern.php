<?php


abstract class BikeFactory
{

    abstract public function getInstance(): BikeCraftingProcess;

    public function build($components): void
    {
        $network = $this->getInstance();
        $network->CostumerBikeOrder();
        $network->factoryBuild($components);
        $network->factoryCraft();
    }
}


class BikeOrder extends BikeFactory
{
    private $name, $type, $color;

    public function __construct(string $name, string $type, string $color)
    {
        $name = $_POST["COSTUMER_NAME"];
        $type = $_POST["BIKE_TYPE"];
        $color = $_POST["BIKE_COLOR"];

        $this->name = $name;
        $this->type = $type;
        $this->color = $color;
    }

    public function getInstance(): BikeCraftingProcess
    {
        return new OrderBikeCostumer($this->name, $this->type, $this->color);
    }
}


class DeliveredBike extends BikeFactory
{
    private $name, $engine, $speed;

    public function __construct(string $name, string $engine, int $speed)
    {
        $name = $_POST["COSTUMER_NAME"];
        $engine = $_POST["BIKE_ENGINE"];
        $speed = $_POST["BIKE_SPEED"];


        $this->name = $name;
        $this->engine = $engine;
        $this->speed = $speed;
    }

    public function getInstance(): BikeCraftingProcess
    {
        return new BuildBikeCostumer($this->name, $this->engine, $this->speed);
    }
}


interface BikeCraftingProcess
{
    public function CostumerBikeOrder(): void;

    public function factoryCraft(): void;

    public function factoryBuild($components): void;
}


class OrderBikeCostumer implements BikeCraftingProcess
{
    private $name, $type, $color;

    public function __construct(string $name, string $type, string $color)
    {
        $name = $_POST["COSTUMER_NAME"];
        $type = $_POST["BIKE_TYPE"];
        $color = $_POST["BIKE_COLOR"];

        $this->name = $name;
        $this->type = $type;
        $this->color = $color;
    }

    public function CostumerBikeOrder(): void
    {
        echo "The Costumer $this->name Ordered " .
            "Bike type $this->type, with a(n) $this->color Color\n";
    }

    public function factoryCraft(): void
    {
        echo "The Bike Factory built the Bike $this->type in a(n) $this->color Color.\n";
    }

    public function factoryBuild($components): void
    {
        echo "The Bike Factory notes the order of the costumer $this->name.\n";
    }
}


class BuildBikeCostumer implements BikeCraftingProcess
{
    private $name, $engine, $speed;

    public function __construct(string $name, string $engine, int $speed)
    {
        $name = $_POST["BIKE_NAME"];
        $engine = $_POST["BIKE_ENGINE"];
        $speed = $_POST["BIKE_SPEED"];

        $this->name = $name;
        $this->engine = $engine;
        $this->speed = $speed;
    }

    public function CostumerBikeOrder(): void
    {
        echo "The Costumer $this->name Ordered Bike engine $this->engine, with Speed of $this->speed of (mph).\n";
    }

    public function factoryCraft(): void
    {
        echo "The Bike Factory notes the order of the costumer $this->name.\n";
    }

    public function factoryBuild($components): void
    {
        echo "The Bike Factory built the Bike $this->type with engine $this->engine and Speed of $this->speed (mph).\n";
    }
}


function costumerOrder(BikeFactory $create)
{

    $create->build("Hello Bike Factory!");
    $create->build("I Wanna buy a new Bike Today!");

}



echo "Building Bike Components:\n";
costumerOrder(new BikeOrder($_POST["COSTUMER_NAME"], $_POST["BIKE_TRANSMISSION"], $_POST["BIKE_ENGINE"], $_POST["BIKE_SPEED"]));
echo "\n\n";

echo "Delivring Bike Components:\n";
costumerOrder(new DeliveredBike($_POST["COSTUMER_NAME"], $_POST["BIKE_ENGINE"], $_POST["BIKE_SPEED"]));
echo "\n\n";

echo "The Costumer " . $_POST["COSTUMER_NAME"] . " Has Successfully bought the bike(Stats):\n"
    . $_POST["BIKE_TYPE"]. "\n" . $_POST["BIKE_COLOR"]. "\n" . $_POST["BIKE_SEATS"]. "\n" . $_POST["BIKE_TRANSMISSION"]. "\n" . $_POST["BIKE_ENGINE"]. "\n" . $_POST["BIKE_SPEED"] ;
