<?php

namespace App\Services\Websocket\Reverb;

use App\Models\Application as ApplicationModel;
use Illuminate\Support\Collection;
use Laravel\Reverb\Application;
use Laravel\Reverb\Contracts\ApplicationProvider;
use Laravel\Reverb\Exceptions\InvalidApplication;

class DatabaseApplicationProvider implements ApplicationProvider
{
    /**
     * Get all of the configured applications as Application instances.
     *
     * @return Collection<Application>
     */
    public function all(): Collection
    {
        return ApplicationModel::query()
            ->reverb()
            ->get()
            ->map(fn(ApplicationModel $app) => $app->toReverbApplication());
    }

    /**
     * Find an application instance by ID.
     *
     * @throws InvalidApplication
     */
    public function findById(string $id): Application
    {
        return $this->find('id', $id);
    }

    /**
     * Find an application instance by key.
     *
     * @throws InvalidApplication
     */
    public function findByKey(string $key): Application
    {
        return $this->find('key', $key);
    }

    /**
     * Find an application instance.
     *
     * @throws InvalidApplication
     */
    public function find(string $key, mixed $value): Application
    {
        /** @var ApplicationModel|null $app */
        $app = ApplicationModel::query()
            ->reverb()
            ->firstWhere($key, '=', $value);

        if (!$app) {
            throw new InvalidApplication('Application not found');
        }

        return $app->toReverbApplication();
    }
}