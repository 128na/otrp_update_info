<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Actions\Info\FailedException;
use App\Actions\Info\LoadJson;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

final class Info extends Component
{
    public string $keyword = '';

    /** @var array<int,string> */
    public array $selectdTags = [];

    public function render(LoadJson $loadJson): View
    {
        try {
            $data = $loadJson();

            return view('livewire.info', [
                'versions' => $this->filter($data['versions']),
                'tags' => $data['tags'],
                'last_modified_at' => $data['last_modified_at'],
            ]);
        } catch (FailedException) {
            return view('livewire.info', [
                'versions' => [],
                'tags' => [],
                'last_modified_at' => '',
            ]);
        }
    }

    public function selected(string $tag): bool
    {
        return in_array($tag, $this->selectdTags, true);
    }

    public function clear(): void
    {
        $this->reset('keyword', 'selectdTags');
    }

    #[On('toggleTag')]
    public function tagClick(string $tag): void
    {
        if ($this->selected($tag)) {
            $this->selectdTags = array_values(array_filter($this->selectdTags, fn ($t): bool => $tag !== $t));
        } else {
            $this->selectdTags[] = $tag;
        }
    }

    /**
     * @template T of array<int,array{version:string,released_at:string,url:string,update_info:array<int,array{version:string,tags:array<int,string>,content:string}>}>  $versions
     *
     * @param  T  $versions
     * @return T
     */
    private function filter(array $versions): array
    {
        $tmp = array_map(function (array $version): array {
            $version['update_info'] = array_filter($version['update_info'], function (array $info): bool {
                foreach ($this->selectdTags as $selectdTag) {
                    if (! in_array($selectdTag, $info['tags'], true)) {
                        return false;
                    }
                }

                if ($this->keyword === '' || $this->keyword === '0') {
                    return true;
                }

                return mb_stripos($info['content'], $this->keyword) !== false;
            });

            return $version;
        }, $versions);

        return array_filter($tmp, fn (array $t): bool => (bool) $t['update_info']);
    }
}
