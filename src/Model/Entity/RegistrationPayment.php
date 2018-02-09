<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * RegistrationPayment Entity
 *
 * @property int $id
 * @property int $registration_id
 * @property \Cake\I18n\FrozenDate $date
 * @property float $amount
 * @property string $status
 * @property bool $is_registration_tax
 *
 * @property \App\Model\Entity\Registration $registration
 */
class RegistrationPayment extends Entity
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
        'registration_id' => true,
        'date' => true,
        'amount' => true,
        'status' => true,
        'is_registration_tax' => true,
        'registration' => true
    ];
}
