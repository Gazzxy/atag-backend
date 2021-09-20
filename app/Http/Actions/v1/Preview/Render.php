<?php

namespace App\Http\Actions\v1\Preview;

class Render
{
    protected array $response;

    public function execute(string $name): self
    {


        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
