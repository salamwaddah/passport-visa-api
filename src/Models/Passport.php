<?php

namespace SalamWaddah\PassportVisa\Models;
class Passport
{
    private $countryCode;

    private $visaFree;

    private $visaOnArrival;

    private $eta;

    private $eVisa;

    private $visaRequired;

    private $notAdmitted;

    private $covidBan;

    public function __construct(
        string $countryCode,
        array  $visaFree,
        array  $visaOnArrival,
        array  $eta,
        array  $eVisa,
        array  $visaRequired,
        array  $notAdmitted,
        array  $covidBan
    )
    {
        $this->countryCode = $countryCode;
        $this->visaFree = $visaFree;
        $this->visaOnArrival = $visaOnArrival;
        $this->eta = $eta;
        $this->eVisa = $eVisa;
        $this->visaRequired = $visaRequired;
        $this->notAdmitted = $notAdmitted;
        $this->covidBan = $covidBan;
    }

    public function toArray(): array
    {
        return [
            'country' => $this->getCountry(),
            'visa-free' => $this->getVisaFree(),
            'visa-on-arrival' => $this->getVisaOnArrival(),
            'electronic-travel-authorization' => $this->getEta(),
            'e-visa' => $this->getEVisa(),
            'visa-required' => $this->getVisaRequired(),
            'not-admitted' => $this->getNotAdmitted(),
            'covid-ban' => $this->getCovidBan(),
        ];
    }

    public function getCountry(): string
    {
        return $this->countryCode;
    }

    public function getVisaFree(): array
    {
        return $this->visaFree;
    }

    public function getVisaOnArrival(): array
    {
        return $this->visaOnArrival;
    }

    public function getEta(): array
    {
        return $this->eta;
    }

    public function getEVisa(): array
    {
        return $this->eVisa;
    }

    public function getVisaRequired(): array
    {
        return $this->visaRequired;
    }

    public function getNotAdmitted(): array
    {
        return $this->notAdmitted;
    }

    public function getCovidBan(): array
    {
        return $this->covidBan;
    }
}