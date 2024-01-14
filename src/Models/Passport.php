<?php

namespace SalamWaddah\PassportVisa\Models;
class Passport
{
    private $cc;
    private $vr;
    private $voa;
    private $vf;

    public function __construct(string $cc, array $vr, array $voa, array $vf)
    {
        $this->cc = $cc;
        $this->vr = $vr;
        $this->voa = $voa;
        $this->vf = $vf;
    }

    public function toArray(): array
    {
        return [
            'country' => $this->getCountry(),
            'vr' => $this->listVisaRequired(),
            'voa' => $this->listVisaOnArrival(),
            'vf' => $this->listVisaFree(),
        ];
    }

    public function getCountry(): string
    {
        return $this->cc;
    }

    public function listVisaOnArrival(): array
    {
        return $this->voa;
    }

    public function listVisaRequired(): array
    {
        return $this->vr;
    }

    public function listVisaFree(): array
    {
        return $this->vf;
    }
}