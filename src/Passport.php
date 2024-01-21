<?php

namespace SalamWaddah\PassportVisa;

use GuzzleHttp\Client;

class Passport
{
    private $cc;

    private $visaFree = [];

    private $visaOnArrival = [];

    private $eta = [];

    private $eVisa = [];

    private $visaRequired = [];

    private $notAdmitted = [];

    private $covidBan = [];

    protected function __construct(string $cc)
    {
        $this->cc = $cc;
    }

    public static function supportedCountries(): array
    {
        $result = [];

        if (($handle = fopen(__DIR__ . '/countries.csv', "r")) !== false) {
            while (($data = fgetcsv($handle, 100)) !== false) {
                $result[] = $data[0];
            }

            fclose($handle);
        }

        return $result;
    }

    public static function make(string $cc): Passport
    {
        $supported = self::supportedCountries();

        if (! in_array(strtoupper($cc), $supported, true)) {
            throw new \Exception("$cc is unsupported country");
        }

        return new static($cc);
    }

    public function get(): array
    {
        $result = $this->fetchData();

        foreach ($result as $item) {
            $code = $item['code'];
            switch ($item['text']) {
                case 'visa-free';
                    $this->visaFree[] = $code;
                    break;
                case 'visa on arrival';
                    $this->visaOnArrival[] = $code;
                    break;
                case 'eTourist';
                case 'eVisa';
                case 'pre-enrollment'; // Ivory Coast
                case 'visa-free (EASE)';
                case 'visa on arrival / eVisa';
                    $this->eVisa [] = $code;
                    break;
                case 'eTA';
                case 'tourist registration'; // Seychelles
                    $this->eta [] = $code;
                    break;
                case 'not admitted';
                    $this->notAdmitted[] = $code;
                    break;
                case 'COVID-19 ban';
                    $this->covidBan[] = $code;
                    break;
                default:
                    $this->visaRequired[] = $code;
                    break;
            }
        }

        return $this->toArray();
    }

    public function listVisaFree(): array
    {
        return $this->visaFree;
    }

    public function listVisaOnArrival(): array
    {
        return $this->visaOnArrival;
    }

    public function listEta(): array
    {
        return $this->eta;
    }

    public function listEVisa(): array
    {
        return $this->eVisa;
    }

    public function listVisaRequired(): array
    {
        return $this->visaRequired;
    }

    public function listNotAdmitted(): array
    {
        return $this->notAdmitted;
    }

    public function listCovidBan(): array
    {
        return $this->covidBan;
    }

    private function toArray(): array
    {
        return [
            'visa-free' => $this->listVisaFree(),
            'visa-on-arrival' => $this->listVisaOnArrival(),
            'electronic-travel-authorization' => $this->listEta(),
            'e-visa' => $this->listEVisa(),
            'visa-required' => $this->listVisaRequired(),
            'not-admitted' => $this->listNotAdmitted(),
            'covid-ban' => $this->listCovidBan(),
        ];
    }

    private function fetchData()
    {
        $endpoint = 'https://www.passportindex.org/incl/compare2.php';

        $headers = [
            'Content-Type' => 'application/x-www-form-urlencoded; charset=UTF-8',
            'origin' => 'https://www.passportindex.org',
            'referer' => 'https://www.passportindex.org/comparebyPassport.php',
            'host' => 'www.passportindex.org',
            'X-Requested-With' => 'XMLHttpRequest',
        ];

        $formData = [
            'compare' => '3',
            'year' => date('Y'),
            'cc' => $this->cc,
        ];

        $client = new Client();

        // todo err handling
        $response = $client->post($endpoint, [
            'headers' => $headers,
            'form_params' => $formData,
        ]);

        return json_decode($response->getBody(), true);
    }
}
