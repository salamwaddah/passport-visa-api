# Passport Visa API

# work in progress
An unofficial passportindex.org API - supports [199 passports](src/countries.csv)

## Usage

```php
require_once __DIR__ . '/../vendor/autoload.php';

$passport = \SalamWaddah\PassportVisa\Passport::make('ma');

$passport->get();
// [
//     "visa-free" => ["tr", etc...],
//     "visa-on-arrival" => ["lb", etc...],
//     "electronic-travel-authorization" => ["kr", etc...],
//     "e-visa" => ["jo", etc...],
//     "visa-required" => ["ru", etc...],
//     "not-admitted" => [],
//     "covid-ban" => [],
// ]

$passport->listVisaFree();
// ["tr", etc...]

### Types
- visa-free
- visa-on-arrival
- electronic-travel-authorization
- e-visa
- visa-required
- not-admitted
- covid-ban
