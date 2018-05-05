<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * PlayersFixture
 *
 */
class PlayersFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'firstName' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'lastName' => ['type' => 'string', 'length' => 50, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'shooting' => ['type' => 'integer', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'A player\'s shooting skill', 'precision' => null, 'autoIncrement' => null],
        'skating' => ['type' => 'integer', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'A player\'s skating skill', 'precision' => null, 'autoIncrement' => null],
        'checking' => ['type' => 'integer', 'length' => 2, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'A player\'s checking skill', 'precision' => null, 'autoIncrement' => null],
        'total' => ['type' => 'integer', 'length' => 3, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => 'A player\'s total skill value', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'Total' => ['type' => 'index', 'columns' => ['total'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'id' => 1,
                'firstName' => 'Lorem ipsum dolor sit amet',
                'lastName' => 'Lorem ipsum dolor sit amet',
                'shooting' => 1,
                'skating' => 1,
                'checking' => 1,
                'total' => 1,
                'created' => '2018-05-05 04:38:38',
                'modified' => '2018-05-05 04:38:38'
            ],
        ];
        parent::init();
    }
}
