<?php 

declare(strict_types=1);

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

final class HTTPTest extends TestCase {
	protected $client;

  protected function setUp() {
    $this->client = new GuzzleHttp\Client([
      'base_uri' => 'http://localhost:8000'
    ]);
  }

	public function testGetIndexPage(){
	  $response = $this->client->get('/');
    $this->assertEquals(200, $response->getStatusCode());
  }

	public function testGetLoginPage(){
	  $response = $this->client->get('/masuk');
    $this->assertEquals(200, $response->getStatusCode());
  }

	public function testGetRegisterPage(){
	  $response = $this->client->get('/daftar');
    $this->assertEquals(200, $response->getStatusCode());
  }
}