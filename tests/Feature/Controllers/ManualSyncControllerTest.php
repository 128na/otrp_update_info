<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Config;
use Tests\TestCase;

final class ManualSyncControllerTest extends TestCase
{
    public function test_index_トークン未設定(): void
    {
        Config::set('google.sync_token', '');
        $testResponse = $this->get('/sync');

        $testResponse->assertStatus(404);
    }

    public function test_index_トークン無し(): void
    {
        Config::set('google.sync_token', 'test');
        $testResponse = $this->get('/sync');

        $testResponse->assertStatus(404);
    }

    public function test_index(): void
    {
        Config::set('google.sync_token', 'test');
        $testResponse = $this->get('/sync?t=test');

        $testResponse->assertStatus(200);
    }
}
