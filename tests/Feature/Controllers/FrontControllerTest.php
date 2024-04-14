<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers;

use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

final class FrontControllerTest extends TestCase
{
    public function test(): void
    {
        $data = [
            'versions' => [],
            'tags' => [],
            'last_modified_at' => '',
        ];
        Storage::disk('public')->put('info.json', json_encode($data));
        $testResponse = $this->get('/');

        $testResponse->assertStatus(200);
    }

    public function test_json無し(): void
    {
        if (Storage::disk('public')->exists('info.json')) {
            Storage::disk('public')->delete('info.json');
        }

        $testResponse = $this->get('/');

        $testResponse->assertStatus(200);
    }
}
