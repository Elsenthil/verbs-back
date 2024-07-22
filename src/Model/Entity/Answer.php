<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Answer Entity
 *
 * @property int $id
 * @property int $test_id
 * @property int $verb_id
 * @property bool $infinitive_given
 * @property string|null $infinitive
 * @property bool $preterit_given
 * @property string|null $preterit
 * @property bool $past_participle_given
 * @property string|null $past_participle
 * @property bool $translation_given
 * @property string|null $translation
 * @property bool $is_done
 * @property bool $is_correct
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Test $test
 * @property \App\Model\Entity\Verb $verb
 */
class Answer extends Entity
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
        'test_id' => true,
        'verb_id' => true,
        'infinitive_given' => true,
        'infinitive' => true,
        'preterit_given' => true,
        'preterit' => true,
        'past_participle_given' => true,
        'past_participle' => true,
        'translation_given' => true,
        'translation' => true,
        'is_done' => true,
        'is_correct' => true,
        'created' => true,
        'modified' => true,
        'test' => true,
        'verb' => true,
    ];
}
