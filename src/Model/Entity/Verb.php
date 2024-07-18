<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Verb Entity
 *
 * @property int $id
 * @property string $infinitive
 * @property string $preterit
 * @property string $past_participle
 * @property string $translation
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 */
class Verb extends Entity
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
        'infinitive' => true,
        'preterit' => true,
        'past_participle' => true,
        'translation' => true,
        'created' => true,
        'modified' => true,
    ];
}
