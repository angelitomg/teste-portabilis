<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Registration Entity
 *
 * @property int $id
 * @property int $student_id
 * @property int $course_id
 * @property string $year
 * @property bool $status
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Course $course
 * @property \App\Model\Entity\RegistrationPayment[] $registration_payments
 */
class Registration extends Entity
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
        'student_id' => true,
        'course_id' => true,
        'year' => true,
        'created' => true,
        'modified' => true,
        'student' => true,
        'course' => true,
        'active' => true,
        'registration_tax_paid' => true,
        'registration_payments' => true,
        'cancellation_date' => true
    ];
}
