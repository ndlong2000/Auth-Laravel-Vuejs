<?php

namespace Tests\Feature\Auth;

use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Response;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCanRegister()
    {
        $faker = Factory::create();
        $pass = $faker->password;
        $data = [
            'id' => $faker->text(10),
            'name' => $faker->name(),
            'email' => $faker->email,
            'address' => $faker->address,
            'phone_number' => '0901291200',
            'password' => $pass,
            're_pass' => $pass,
        ];
        $response = $this->postJson('/api/register',$data);
        $response->assertStatus(Response::HTTP_OK);
    }

    public function testCanNotRegister()
    {
        $faker = Factory::create();
        $pass = $faker->password;
        $data1 = [
            'id' => $faker->text(10),
            'name' => $faker->name(),
            'email' => $faker->email,
            'address' => $faker->address,
            'phone_number' => '0901291200',
            'password' => '12345678',
            're_pass' => '1213411312',
        ];
        $response = $this->postJson('/api/register',$data1);
        $response->assertSeeText( "The re pass and password must match.");
        $response->assertStatus(422);
    }

}
