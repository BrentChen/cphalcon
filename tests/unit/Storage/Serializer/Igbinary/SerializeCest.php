<?php
declare(strict_types=1);

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalconphp.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace Phalcon\Test\Unit\Storage\Serializer\Igbinary;

use Codeception\Example;
use function igbinary_serialize;
use Phalcon\Storage\Serializer\Igbinary;
use stdClass;
use UnitTester;

/**
 * Class SerializeCest
 */
class SerializeCest
{
    /**
     * Tests Phalcon\Storage\Serializer\Igbinary :: serialize()
     *
     * @dataProvider getExamples
     *
     * @param UnitTester $I
     * @param Example    $example
     *
     * @author       Phalcon Team <team@phalconphp.com>
     * @since        2019-03-30
     */
    public function storageSerializerIgbinarySerialize(UnitTester $I, Example $example)
    {
        $I->wantToTest('Storage\Serializer\Igbinary - serialize() - ' . $example[0]);
        $serializer = new Igbinary($example[1]);

        $expected = $example[2];
        $actual   = $serializer->serialize();
        $I->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    private function getExamples(): array
    {
        return [
            [
                'null',
                null,
                null,
            ],
            [
                'true',
                true,
                true,
            ],
            [
                'false',
                false,
                false,
            ],
            [
                'integer',
                1234,
                1234,
            ],
            [
                'float',
                1.234,
                1.234,
            ],
            [
                'string',
                'Phalcon Framework',
                igbinary_serialize('Phalcon Framework'),
            ],
            [
                'array',
                ['Phalcon Framework'],
                igbinary_serialize(["Phalcon Framework"]),
            ],
            [
                'object',
                new stdClass(),
                igbinary_serialize(new stdClass()),
            ],
        ];
    }
}
