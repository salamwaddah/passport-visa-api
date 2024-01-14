<?php

namespace SalamWaddah\PassportVisa\Models;

class Visa
{
    private $from;
    private $to;
    private $duration;
    private $status;

    public function __construct(string $from, string $to, string $duration, string $status)
    {
        $this->from = $from;
        $this->to = $to;
        $this->duration = $duration;
        $this->status = $status;
    }

    public function toArray(): array
    {
        return [
            'passport' => $this->getFrom(),
            'destination' => $this->getTo(),
            'duration' => $this->getDuration(),
            'status' => $this->getStatus(),
        ];
    }

    public function getFrom(): string
    {
        return $this->from;
    }

    public function getTo(): string
    {
        return $this->to;
    }

    public function getDuration(): string
    {
        return $this->duration;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}