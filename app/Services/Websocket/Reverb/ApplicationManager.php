<?php

namespace App\Services\Websocket\Reverb;

class ApplicationManager extends \Laravel\Reverb\ApplicationManager
{
    /**
     * Create an instance of the configuration driver.
     */
    public function createDatabaseDriver(): DatabaseApplicationProvider
    {
        return new DatabaseApplicationProvider();
    }
}