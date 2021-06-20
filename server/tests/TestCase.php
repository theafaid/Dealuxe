<?php

namespace Tests;

use Illuminate\Http\UploadedFile;
use Facades\Tests\Setup\AdminFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use RefreshDatabase, CreatesApplication;

    /**
     * @param JWTSubject $user
     * @param $method
     * @param $url
     * @param array $data
     * @param array $headers
     * @return \Illuminate\Foundation\Testing\TestResponse
     */
    public function jsonAs(JWTSubject $user, $method, $url, $data = [], $headers = [])
    {
        $token = auth()->tokenById($user->id);

        return $this->json($method, $url, $data, array_merge($headers, [
                'AUTHORIZATION' => "Bearer {$token}"
            ]));
    }

    /**
     * @param $user
     * @param string $driver
     * @return $this
     */
    public function signIn($user = null, $driver = 'admin')
    {
        $user = $user ?: AdminFactory::create();

        $this->actingAs($user, $driver);

        return $this;
    }

    public function generateImage($name = 'img.png')
    {
        return UploadedFile::fake()->image($name);
    }
}
