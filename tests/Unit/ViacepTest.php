<?php

namespace Tests\Unit;

use App\Services\ViacepService;
use Tests\TestCase;

class ViacepTest extends TestCase
{
    /** @test */
    public function when_send_a_cep_to_api()
    {
      $cep = '13606-536';
      $address = ViacepService::getAddress($cep);
      $this->assertIsArray($address);
      $this->assertEquals($address['cep'], $cep);
      $this->assertCount(6, $address);
    }
}
