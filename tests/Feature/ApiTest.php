<?php

namespace Tests\Feature;

use App\Models\Data;
use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRequest()
    {
        $entrypoint = route('api.receiver');
        $api_data = [
            'versions' => [
                ['id' => 1, 'version' => '123', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://example.com'],
                ['id' => 2, 'version' => '456', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://hoge.com'],
                ['id' => 3, 'version' => '789', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://fuga.com'],
            ],
            'tags' => [
                ['id' => 1, 'name' => 'tag1'],
                ['id' => 2, 'name' => 'tag2'],
                ['id' => 3, 'name' => 'tag3'],
            ],
            'update_info' => [
                ['id' => 1, 'version' => 1, 'tags' => [1, 2], 'content' => 'aaa'],
                ['id' => 2, 'version' => 2, 'tags' => [], 'content' => 'bbb'],
                ['id' => 3, 'version' => 1, 'tags' => [2], 'content' => 'ccc'],
            ],
        ];
        $converted_data = [
            'versions' => [
                [
                    'id' => 1, 'version' => '123', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://example.com',
                    'update_info' => [
                        ['id' => 1, 'version' => 1, 'tags' => [
                            ['id' => 1, 'name' => 'tag1'],
                            ['id' => 2, 'name' => 'tag2'],
                        ], 'content' => 'aaa'],
                        ['id' => 3, 'version' => 1, 'tags' => [
                            ['id' => 2, 'name' => 'tag2'],
                        ], 'content' => 'ccc'],
                    ],
                ],
                [
                    'id' => 2, 'version' => '456', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://hoge.com',
                    'update_info' => [
                        ['id' => 2, 'version' => 2, 'tags' => [], 'content' => 'bbb'],
                    ],
                ],
                [
                    'id' => 3, 'version' => '789', 'released_at' => '2019-01-01 12:34:56', 'url' => 'http://fuga.com',
                    'update_info' => [],
                ],
            ],
            'tags' => [
                ['id' => 1, 'name' => 'tag1'],
                ['id' => 2, 'name' => 'tag2'],
                ['id' => 3, 'name' => 'tag3'],
            ],
        ];

        // getで405を返す
        $response = $this->get($entrypoint);
        $response->assertStatus(405);

        // トークンのないpostで404を返す
        $response = $this->post($entrypoint);
        $response->assertStatus(404);

        // 不正なトークンのpostで404を返す
        $data = [
            'token' => '334',
            'api_version' => '1',
            'data' => ['hoge' => 'fuga'],
        ];
        $response = $this->post($entrypoint, $data);
        $response->assertStatus(404);

        // 適切なトークンのpostで200を返す
        $data = [
            'token' => config('app.api.token'),
            'version' => '1',
            'data' => json_encode($api_data),
        ];
        $response = $this->post($entrypoint, $data);
        $response->assertStatus(200);

        // データが同一か
        $this->assertEquals(
            Data::get(1),
            $converted_data
        );

        // api version違い
        $data = [
            'token' => config('app.api.token'),
            'version' => '2',
            'data' => json_encode($api_data),
        ];
        $response = $this->post($entrypoint, $data);
        $response->assertStatus(200);

        // データが同一か
        $this->assertEquals(
            Data::get(2),
            $converted_data
        );
    }
}
