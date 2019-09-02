<?php

namespace Spatie\BinaryUuid\Test;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Spatie\BinaryUuid\UuidServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->setUpDatabase();
    }

    protected function getPackageProviders($app): array
    {
        return [UuidServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    protected function setUpDatabase()
    {
        Schema::dropIfExists('test');

        Schema::create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('uuid');
            $table->uuid('relation_uuid')->nullable();
            $table->timestamps();
        });
    }
}
