<?php

use SalamWaddah\PassportVisa\Passport;


describe('supported countries', function () {
    it('valid country code', function () {
        expect(Passport::isSupported('ma'))->toBeTrue();
    });

    it('invalid country code', function () {
        expect(Passport::isSupported('zzz'))->toBeFalse();
    });
});
