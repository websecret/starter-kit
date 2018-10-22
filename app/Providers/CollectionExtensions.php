<?php

namespace App\Providers;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionExtensions extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // See: https://github.com/sebastiaanluca/laravel-helpers/blob/4bedf8500149cd038ad644bd69e1625553edf578/src/Collections/CollectionMacrosServiceProvider.php#L68
        Collection::macro('transpose', function (array $rows = null) {
            if ($this->isEmpty()) {
                return $this;
            }

            $rows = $rows ?? $this->values()->reduce(function (array $rows, array $values) {
                    return array_unique(array_merge($rows, array_keys($values)));
                }, []);
            $keys = $this->keys()->toArray();
            // Transpose the matrix
            $items = array_map(function (...$items) use ($keys) {
                // The collection's keys now become column headers
                return array_combine($keys, $items);
            }, ...$this->values());
            // Add the new row headers
            $items = array_combine($rows, $items);
            return new static($items);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
