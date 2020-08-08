<?php
namespace App\Shared\Domain\Services;

use App\Shared\Domain\Uuid;

interface ServiceInterface
{
    public function add(array $request): Uuid;
    public function edit(array $request, string $uuid): Uuid;
    public function remove(string $uuid): Uuid;
    public function find(string $uuid): array;
    public function all(?array $query): array;
}