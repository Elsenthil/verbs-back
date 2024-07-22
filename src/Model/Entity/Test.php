<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Test Entity
 *
 * @property int $id
 * @property string|null $name
 * @property string $mark
 * @property int $answer_not_done_count
 * @property int $answer_done_count
 * @property int $wrong_answer_count
 * @property int $right_answer_count
 * @property int|null $answer_count
 * @property bool $is_finished
 * @property \Cake\I18n\DateTime $created
 * @property \Cake\I18n\DateTime $modified
 *
 * @property \App\Model\Entity\Answer[] $answers
 */
class Test extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'name' => true,
        'mark' => true,
        'answer_not_done_count' => true,
        'answer_done_count' => true,
        'wrong_answer_count' => true,
        'right_answer_count' => true,
        'answer_count' => true,
        'is_finished' => true,
        'created' => true,
        'modified' => true,
        'answers' => true,
    ];
}
