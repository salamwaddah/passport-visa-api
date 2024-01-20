# Passport Visa API

An unofficial passportindex.org API

## Usage

```php
require_once __DIR__ . '/../vendor/autoload.php';

$passport = new \SalamWaddah\PassportVisa\PassportVisa('ma');

$data = $passport->travelingTo('tr');

// $data 
// [
//     "passport" => "ma",
//     "destination" => "tr",
//     "duration" => "90",
//     "status" => "vf",
// ]

$info = $passport->info();

// $info
// [
//     "country" => "ma",
//     "vf" => ["tr", etc...],
//     "voa" => ["lb", etc...],
//     "vr" => ["ru", etc...],
// ] 

## Types
- visa-free
- visa-on-arrival
- electronic-travel-authorization
- e-visa
- visa-required
- not-admitted
- covid-ban
