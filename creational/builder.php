<?php

class Car
{
    public int $noDoors;
    public string $color;
    public bool $boot;
    public float $engine;

    public function show(): String
    {
        $boot = $this->boot ? 'yes' : 'no';
        return "Car built with $this->noDoors doors, $this->color color, boot: $boot, engine: $this->engine";
    }
}

class CarBuilder
{
    readonly private Car $car;
    public function __construct()
    {
        $this->car = new Car();
    }

    public function build(): Car
    {
        return $this->car;
    }

    public function setNoDoors(int $noDoors): CarBuilder
    {
        $this->car->noDoors = $noDoors;
        return $this;
    }

    public function setColor(string $color): CarBuilder
    {
        $this->car->color = $color;
        return $this;
    }

    public function setBoot(bool $boot): CarBuilder
    {
        $this->car->boot = $boot;
        return $this;
    }

    public function setEngine(float $engine): CarBuilder
    {
        $this->car->engine = $engine;
        return $this;
    }
}

echo (new CarBuilder())
    ->setNoDoors(4)
    ->setColor('red')
    ->setBoot(true)
    ->setEngine(1.6)
    ->build()->show();

echo PHP_EOL;

echo (new CarBuilder())
    ->setNoDoors(2)
    ->setColor('blue')
    ->setBoot(false)
    ->setEngine(2.0)
    ->build()->show();