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
        echo "<p>The Costumer <i style=\"color: #A9048A\">$this->name</i> Ordered " ."Bike type <i style=\"color: #A9048A\">$this->type</i>, with a(n) <i style=\"color: #A9048A\">$this->color</i> Color\n</p>";
    }

    public function factoryCraft(): void
    {
        echo "<p>The Bike Factory built the Bike <i style=\"color: #A9048A\">$this->type</i> in a(n) <i style=\"color: #A9048A\">$this->color</i> Color.\n</p>";
    }

    public function factoryBuild($components): void
    {
        echo "<p>The Bike Factory notes the order of the costumer <i style=\"color: #A9048A\">$this->name</i>.\n</p>";
    }
}


class BuildBikeCostumer implements BikeCraftingProcess
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

    public function CostumerBikeOrder(): void
    {
        echo "<p>The Costumer <i style=\"color: #A9048A\">$this->name</i> Ordered Bike engine <i style=\"color: #A9048A\">$this->engine</i>, with Speed of <i style=\"color: #A9048A\">$this->speed</i> of (mph).\n</p>";
    }

    public function factoryCraft(): void
    {
        echo "<p>The Bike Factory built the Bike <i style=\"color: #A9048A\">$this->type</i> with engine <i style=\"color: #A9048A\">$this->engine</i> and Speed of <i style=\"color: #A9048A\">$this->speed</i> (mph).\n</p>";
    }

    public function factoryBuild($components): void
    {
        echo "<p>The Bike Factory notes the order of the costumer <i style=\"color: #A9048A\">$this->name</i>.\n</p>";
    }
}


function costumerOrder(BikeFactory $create)
{

    $create->build("Hello Bike Factory!");
    $create->build("I Wanna buy a new Bike Today!");

}


echo "<body style=\"
color: rgb(255, 255, 255);
background-color: rgb(28, 1, 36);
margin: auto;
padding-left: 25%\">";

echo "<h2 style=\"color: #ff969e\">Building Bike Components:</h2>\n";
costumerOrder(new BikeOrder($_POST["COSTUMER_NAME"], $_POST["BIKE_TRANSMISSION"], $_POST["BIKE_ENGINE"], $_POST["BIKE_SPEED"]));
echo "\n\n";

echo "<h2 style=\"color: #ff969e\">Delivring Bike Components:</h2>\n";
costumerOrder(new DeliveredBike($_POST["COSTUMER_NAME"], $_POST["BIKE_ENGINE"], $_POST["BIKE_SPEED"]));
echo "\n\n";

$name = $_POST["COSTUMER_NAME"];
$type = $_POST["BIKE_TYPE"];
$color = $_POST["BIKE_COLOR"];
$seats = $_POST["BIKE_SEATS"];
$transmission = $_POST["BIKE_TRANSMISSION"];
$engine = $_POST["BIKE_ENGINE"];
$speed = $_POST["BIKE_SPEED"]; 

echo "<h3 style=\"color: #ff969e\">The Costumer " . $_POST["COSTUMER_NAME"] . " Has Successfully bought the bike(Stats):</h3>\n"
    . "<p>BIKE_TYPE: <b style=\"color: #20dacc\">". $_POST["BIKE_TYPE"] . "</b><br>"
    . "\nBIKE_COLOR: <b style=\"color: #20dacc\">" . $_POST["BIKE_COLOR"] . "</b><br>"
    . "\nBIKE_SEATS: <b style=\"color: #20dacc\">" . $_POST["BIKE_SEATS"] . "</b><br>"
    . "\nBIKE_TRANSMISSION: <b style=\"color: #20dacc\">" . $_POST["BIKE_TRANSMISSION"] . "</b><br>"
    . "\nBIKE_ENGINE: <b style=\"color: #20dacc\">" . $_POST["BIKE_ENGINE"] . "</b><br>"
    . "\nBIKE_SPEED: <b style=\"color: #20dacc\">" . $_POST["BIKE_SPEED"] . "</b>mph</p>" ;


// ============Linking DB=================

$host = "localhost";
$dbname = "SINGLETON";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("\n\n<p style=\"color: #ff0008\">Connection failed: " . $conn->connect_error . " 🚨 Failure! Record has not been Saved.</p>");
}

$sql = "INSERT INTO BIKE_PATTERN (COSTUMER_NAME, BIKE_TYPE, BIKE_COLOR, BIKE_SEATS, BIKE_ENGINE, BIKE_TRANSMISSION, BIKE_SPEED)
VALUES ('$name', '$type', '$color', '$seats', '$engine', '$transmission', '$speed')";

if ($conn->query($sql) === TRUE) {
  echo "\n\n<p style=\"color: #49e153\">New Bike sell has been created successfully✔</p>";
} else {
  echo "\n\n<p style=\"color: #ff0008\">Error: " . $sql . "<br>" . $conn->error . " 🚨 Failure! Record has not been Saved.</p>";
}
echo"</body>";

$conn->close();
?>