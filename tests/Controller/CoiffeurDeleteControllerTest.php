<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CoiffeurDeleteControllerTest extends WebTestCase 
{
    public function testCoiffeurDelete()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@gmail.com',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('POST', '/coiffeur/1/delete');

        // $this->assertTrue($client->getResponse()->isRedirection());
        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertSame(1, $crawler->filter('html:contains("Workshop Barbershop")')->count());
    }
}