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

namespace Phalcon\Test\Integration\Db\Column;

use Codeception\Example;
use IntegrationTester;
use Phalcon\Db\Column;

/**
 * Class HasDefaultCest
 */
class HasDefaultCest
{
    /**
     * Tests Phalcon\Db\Column :: hasDefault() - Mysql
     *
     * @param IntegrationTester $I
     * @param Example           $data
     *
     * @dataProvider connectionProvider
     *
     * @author       Phalcon Team <team@phalconphp.com>
     * @since        2018-11-13
     */
    public function dbColumnHasDefault(IntegrationTester $I, Example $data)
    {
        $I->wantToTest(
            sprintf(
                'Db\Column - hasDefault() - %s',
                $data['name']
            )
        );

        $columns  = $data['data'];
        $expected = $data['expected'];

        foreach ($columns as $index => $column) {
            $I->assertEquals(
                $expected[$index],
                $column->hasDefault()
            );
        }
    }

    /**
     * Returns the connections for each data provider
     *
     * @author Phalcon Team <team@phalconphp.com>
     * @since  2018-11-13
     *
     * @return array
     */
    private function connectionProvider()
    {
        return [
            [
                'name'     => 'Mysql',
                'data'     => [
                    0 => Column::__set_state(
                        [
                            'columnName'    => 'field_primary',
                            'schemaName'    => null,
                            'type'          => Column::TYPE_INTEGER,
                            'isNumeric'     => true,
                            'size'          => 11,
                            'scale'         => 0,
                            'default'       => null,
                            'unsigned'      => false,
                            'notNull'       => true,
                            'autoIncrement' => true,
                            'primary'       => true,
                            'first'         => true,
                            'after'         => null,
                            'bindType'      => Column::BIND_PARAM_INT,
                        ]
                    ),
                    1 => Column::__set_state(
                        [
                            'columnName'    => 'field_bigint',
                            'schemaName'    => null,
                            'type'          => Column::TYPE_BIGINTEGER,
                            'isNumeric'     => true,
                            'size'          => 20,
                            'scale'         => 0,
                            'default'       => 1,
                            'unsigned'      => false,
                            'notNull'       => false,
                            'autoIncrement' => false,
                            'primary'       => false,
                            'first'         => false,
                            'after'         => 'field_bit_default',
                            'bindType'      => Column::BIND_PARAM_INT,
                        ]
                    ),
                ],
                'expected' => [
                    0 => false,
                    1 => true,
                ],
            ],
            [
                'name'     => 'Postgresql',
                'data'     => [
                    Column::__set_state(
                        [
                            'columnName'    => 'field_primary',
                            'schemaName'    => null,
                            'type'          => Column::TYPE_INTEGER,
                            'isNumeric'     => true,
                            'size'          => 0,
                            'scale'         => 0,
                            'default'       => "nextval('dialect_table_field_primary_seq'::regclass)",
                            'unsigned'      => false,
                            'notNull'       => true,
                            'autoIncrement' => true,
                            'primary'       => true,
                            'first'         => true,
                            'after'         => null,
                            'bindType'      => Column::BIND_PARAM_INT,
                        ]
                    ),
                    Column::__set_state(
                        [
                            'columnName'    => 'field_bigint',
                            'schemaName'    => null,
                            'type'          => Column::TYPE_BIGINTEGER,
                            'isNumeric'     => true,
                            'size'          => 0,
                            'scale'         => 0,
                            'default'       => 1,
                            'unsigned'      => false,
                            'notNull'       => false,
                            'autoIncrement' => false,
                            'primary'       => false,
                            'first'         => false,
                            'after'         => 'field_bit_default',
                            'bindType'      => Column::BIND_PARAM_INT,
                        ]
                    ),
                ],
                'expected' => [
                    0 => false,
                    1 => true,
                ],
            ],
        ];
    }
}
