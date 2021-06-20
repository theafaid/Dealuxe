<?php

namespace Tests\Feature\Countries;

use Tests\TestCase;
use Facades\Tests\Setup\CountryFactory;

class CountryIndexTest extends TestCase
{
    /** @test */
    function it_returns_a_collection_of_countries()
    {
        $countries = CountryFactory::create(4);

        $response = $this->getJson(route('countries.index'));

        $countries->each(function ($country) use ($response){
            $response->assertJsonFragment(['name' => $country->name]);
        });
    }
}
