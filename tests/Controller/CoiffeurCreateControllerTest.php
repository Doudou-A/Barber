<?php

namespace App\tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class CoiffeurCreateControllerTest extends WebTestCase
{
    public function testCoiffeurCreate()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'admin@gmail.com',
            'PHP_AUTH_PW'   => 'password',
        ]);

        $crawler = $client->request('GET', '/admin/coiffeur');

        $this->assertSame(200, $client->getResponse()->getStatusCode());
        $this->assertTrue($client->getResponse()->isSuccessful());
        $this->assertEquals(1, $crawler->filter('h1:contains("Ajouter un Coiffeur")')->count());

        $file = new UploadedFile(__DIR__.'/../../public/img/138.png', '138.jpg');
        $snap = new UploadedFile(__DIR__.'/../../public/img/barber.png', 'barber.jpg');
        
        $form = $crawler->selectButton('Ajouter')->form();

        $form['coiffeur[file]'] = $snap;
        $form['coiffeur[snap]'] = $snap;
        $form['coiffeur[username]'] = 'username';
        $form['coiffeur[facebook]'] = 'www.facebook.fr';
        $form['coiffeur[insta]'] = 'www.insta.fr';

        $client->submit($form);

        $this->assertTrue($client->getResponse()->isRedirection());
        $crawler = $client->followRedirect();

        /* echo $client->getResponse()->getContent(); */
        $this->assertSame(1, $crawler->filter('html:contains("Coiffeur AJouté/Modifié avec succès !")')->count());
    }
}