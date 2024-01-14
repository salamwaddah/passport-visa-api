<?php

namespace SalamWaddah\PassportVisa;

use GuzzleHttp\Client;
use SalamWaddah\PassportVisa\Models\Passport;
use SalamWaddah\PassportVisa\Models\Visa;

class PassportVisa
{
    private $cc;

    public function __construct(string $cc)
    {
        $this->cc = $cc;
    }

    public function travelingTo(string $to): Visa
    {
        $to = strtolower($to);

        $result = $this->fetchData();

        $dur = '';
        $status = 'voa';

        foreach ($result as $item) {
            $code = strtolower($item['code']);

            if ($code != $to) {
                continue;
            }

            $dur = $item['dur'];

            switch ($item['text']) {
                case 'visa-free';
                case 'eVisa';
                case 'visa-free (EASE)';
                    $status = 'vf';
                    break;
                case 'visa required';
                    $status = 'vr';
                    break;
                default:
                    break;
            }
        }

        return new Visa($this->cc, $to, $dur, $status);
    }

    public function info(): Passport
    {
        $result = $this->fetchData();

        $vf = [];
        $voa = [];
        $vr = [];

        foreach ($result as $item) {
            $code = $item['code'];
            switch ($item['text']) {
                case 'visa-free';
                case 'eVisa';
                case 'visa-free (EASE)';
                    $vf[] = $code;
                    break;
                case 'visa required';
                    $vr[] = $code;
                    break;
                default:
                    $voa[] = $code;
                    break;
            }
        }

        return new Passport($this->cc, $vr, $voa, $vf);
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
