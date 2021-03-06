<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 17/12/2018
 * Time: 11:05
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class CompetitionsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsToMany('Associations');
        $this->hasMany('Results', [
            'dependent' => true,
            'cascadeCallbacks' => true,
        ]);
    }

}