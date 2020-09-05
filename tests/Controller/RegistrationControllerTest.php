<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegistrationControllerTest extends WebTestCase
{
    public function testRegistration()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/inscription');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('h1:contains("Créer un compte")')->count());

        $form = $crawler->selectButton('Créer mon compte')->form();
        
        $form['registration[email]'] = 'email@gmail.com';
        $form['registration[name]'] = 'name';
        $form['registration[firstName]'] = 'firstName';
        $form['registration[number]'] = 0611111110;
        $form['registration[password]'] = 'password';
        $form['registration[confirm_password]'] = 'password';

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirection());
        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(1, $crawler->filter('html:contains("Identifier-vous")')->count());
    }
}