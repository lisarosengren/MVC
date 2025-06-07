<?php

namespace App\Tests;

use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProjControllerTest extends WebTestCase
{
    /**
     * Test "home" in project
     */
    public function testProjHome(): void
    {
        $client = static::createClient();

        $client->request('GET', '/proj');
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'vaknar');
    }

    /**
     * Test the initialization route of the game
     */
    public function testInit(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/init');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('p', 'sovrum');
    }

    /**
     * Test JSON route for one item.
     */
    public function testJsonItem(): void
    {
        $client = static::createClient();
        $client->request('POST', '/proj/api/one_item', ['item' => 'godispapper']);
        $res = (string) $client->getResponse()->getContent();
        $this->assertStringContainsString('Banana', $res);
        $this->assertResponseIsSuccessful();
    }

    public function testJsonInventory(): void
    {
        $client = static::createClient();
        $client->request('GET', '/proj/api/inventory');
        $res = (string )$client->getResponse()->getContent();
        $this->assertStringContainsString('spel', $res);
        $this->assertResponseIsSuccessful();
    }


}
