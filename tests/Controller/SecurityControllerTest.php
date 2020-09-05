<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    public function testLogin()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/login');

        $this->assertSame(200, $client->getResponse()->getStatusCode());

        $form = $crawler->selectButton('login')->form();

        $form['_username'] = 'admin@gmail.com';
        $form['_password'] = 'password';

        $client->submit($form);

        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(1, $crawler->filter('html:contains("Workshop Barbershop")')->count());
    }

    public function testLogout()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@gmail.com',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/logout');

        $crawler = $client->followRedirect();

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Workshop Barbershop")')->count());
    }
}