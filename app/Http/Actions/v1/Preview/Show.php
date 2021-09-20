<?php

namespace App\Http\Actions\v1\Preview;

class Show
{
    protected array $response;

    public function execute(): self
    {
        $this->response = config('brightfm.mailtemplates');

        return $this;
    }

    public function response(): array
    {
        return $this->response;
    }
}
