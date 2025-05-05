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
    public function testCreateDice(): void
    {
        $die = new Dice();
        $this->assertInstanceOf("\App\Dice\Dice", $die);

        $res = $die->getAsString();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct object and use
     * roll method. Changed from assertIsInt
     * because phpstan complaining
     */
    public function testRoll(): void
    {
        $die = new Dice();

        $res = $die->roll();
        $this->assertNotEmpty($res);
    }

    /**
     * Construct object and use
     * roll method.
     * Check that getValue returns
     * right value.
     */
    public function testGetValue(): void
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
    public function testGetAsString(): void
    {
        $die = new Dice();

        $value = $die->getValue();
        $exp = "[{$value}]";
        $res = $die->getAsString();


        $this->assertEquals($exp, $res);
    }


    /**
 * Create a mocked object that always returns 6.
 */
    public function testStubRollDiceLastRoll(): void
    {
        // Create a stub for the Dice class.
        $stub = $this->createMock(Dice::class);

        // Configure the stub.
        $stub->method('roll')
             ->willReturn(6);

        $res = $stub->roll();
        $exp = 6;
        $this->assertEquals($exp, $res);
    }
}
