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

namespace Phalcon\Test\Unit\Cache\Cache;

use Phalcon\Cache\Adapter\Apcu;
use Phalcon\Cache\Cache;
use Phalcon\Cache\Exception\InvalidArgumentException;
use UnitTester;
use function uniqid;

/**
 * Class SetMultipleCest
 */
class SetMultipleCest
{
    /**
     * Tests Phalcon\Cache\Cache :: setMultiple()
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-05-01
     */
    public function cacheCacheSetMultiple(UnitTester $I)
    {
        $I->wantToTest('Cache\Cache - setMultiple()');

        $adapter = new Cache(new Apcu());

        $key1 = uniqid();
        $key2 = uniqid();
        $adapter->setMultiple(
            [
                $key1 => 'test1',
                $key2 => 'test2',
            ]
        );

        $actual = $adapter->has($key1);
        $I->assertTrue($actual);
        $actual = $adapter->has($key2);
        $I->assertTrue($actual);

        $expected = [
            $key1     => 'test1',
            $key2     => 'test2',
            'unknown' => 'default-unknown',
        ];
        $actual   = $adapter->getMultiple([$key1, $key2, 'unknown'], 'default-unknown');
        $I->assertEquals($expected, $actual);
    }

    /**
     * Tests Phalcon\Cache\Cache :: setMultiple() - exception
     *
     * @param UnitTester $I
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2019-05-01
     */
    public function cacheCacheSetMultipleException(UnitTester $I)
    {
        $I->wantToTest('Cache\Cache - setMultiple() - exception');

        $I->expectThrowable(
            new InvalidArgumentException('The key contains invalid characters'),
            function () {
                $adapter = new Cache(new Apcu());
                $adapter->setMultiple(
                    [
                        'abc$^' => 'test1',
                        'abd$^' => 'test2',
                    ]
                );
            }
        );

        $I->expectThrowable(
            new InvalidArgumentException('The keys need to be an array or instance of Traversable'),
            function () {
                $adapter = new Cache(new Apcu());
                $actual  = $adapter->setMultiple(1234);
            }
        );
    }
}
