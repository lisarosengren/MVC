<?php

namespace App\Dice;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for class Dice.
 */
class DiceTest extends TestCase
{
    /**
     * Construct object and verify that the object has the expected
     * properties, use no arguments.
     */
    public function testCreateDice()
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct object and use 
     * roll method.
     */
    public function testRoll()
    {
        $die = new Dice();

        $res = $die->roll();
        $this->assertIsInt($res);
    }

    /**
     * Construct object and use 
     * roll method.
     * Check that getValue returns 
     * right value.
     */
    public function testGetValue()
    {
        $die = new Dice();

        $exp = $die->roll();
        $res = $die->getValue();
        $this->assertEquals($exp, $res);
    }

    /**
     * Construct object and use 
     * roll method.
     * Check that getAsString returns 
     * right value.
     */
    public function testGetAsString()
    {
        $die = new Dice();

        $value = $die->getValue();
        $exp = "[{$value}]";
        $res = $die->getAsString();


        $this->assertEquals($exp, $res);
    }
}