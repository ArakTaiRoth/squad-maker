<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Player Entity
 *
 * @property int $id
 * @property string $firstName
 * @property string $lastName
 * @property int $shooting
 * @property int $skating
 * @property int $checking
 * @property int $total
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Squad[] $squads
 */
class Player extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'firstName' => true,
        'lastName' => true,
        'shooting' => true,
        'skating' => true,
        'checking' => true
    ];
}
