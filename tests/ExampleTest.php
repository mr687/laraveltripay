<?php

namespace Mr687\Laraveltripay\Tests;

use Orchestra\Testbench\TestCase;
use Mr687\Laraveltripay\LaraveltripayServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaraveltripayServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
