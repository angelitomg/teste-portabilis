<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Course Entity
 *
 * @property int $id
 * @property string $name
 * @property float $monthly_amount
 * @property float $registration_tax
 * @property string $period
 * @property int $duration
 * @property \Cake\I18n\FrozenTime $created
 * @property \Cake\I18n\FrozenTime $modified
 */
class Course extends Entity
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
        'name' => true,
        'monthly_amount' => true,
        'registration_tax' => true,
        'period' => true,
        'duration' => true,
        'created' => true,
        'modified' => true
    ];

    const COURSE_PERIOD_MORNING = 'morning';
    const COURSE_PERIOD_AFTERNOON = 'afternoon';
    const COURSE_PERIOD_NIGHT = 'night';

    protected $periodsList = [
        self::COURSE_PERIOD_MORNING => 'Morning',
        self::COURSE_PERIOD_AFTERNOON => 'Afternoon',
        self::COURSE_PERIOD_NIGHT => 'Night',
    ];

    /**
     * getPeriodsList method
     *
     * @return mixed
     */
    public function getPeriodsList()
    {
        $period = [];
        foreach ($this->periodsList as $type => $message) {
            $period[$type] = __($message);
        }

        return $period;
    }

    /**
     * getPeriod method
     *
     * @param string $period Status
     * @return mixed
     */
    public function getPeriod($period)
    {
        $periodName = (isset($this->periodsList[$period])) ? __($this->periodsList[$period]) : '';

        return $periodName;
    }
}
