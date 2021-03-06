<?php

/**
 * This file is part of the Phalcon Framework.
 *
 * (c) Phalcon Team <team@phalcon.io>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Phalcon\Test\Database\Db\Column;

use DatabaseTester;
use Phalcon\Test\Fixtures\Traits\DbTrait;

class GetSizeCest
{
    use DbTrait;

    /**
     * Tests Phalcon\Db\Column :: getSize()
     *
     * @author Phalcon Team <team@phalcon.io>
     * @since  2020-02-01
     */
    public function dbColumnGetSize(DatabaseTester $I)
    {
        $I->wantToTest("Db\Column - getSize()");

        $columns         = $this->getColumnsArray();
        $expectedColumns = $this->getColumnsObjects();

        foreach ($expectedColumns as $index => $column) {
            $I->assertEquals(
                $columns[$index]['size'],
                $column->getSize()
            );
        }
    }
}
