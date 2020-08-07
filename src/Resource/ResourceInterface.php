<?php

namespace PsHttp\Resource;

interface ResourceInterface
{
    public function getResourceName(): string;

    public function getAll(): array;
    public function getById(int $id);
    public function create($object);
}
