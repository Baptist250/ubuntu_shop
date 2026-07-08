<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;

trait RefreshDatabaseForTesting
{
    use RefreshDatabase;

    protected function migrateFreshUsing(): array
    {
        return array_merge([
            '--drop-views' => false,
            '--drop-types' => false,
            '--seed' => false,
        ], [
            '--force' => true,
        ]);
    }
}
