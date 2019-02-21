
<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 17/12/2018
 * Time: 11:04
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class AssociationsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsToMany('Competitions');
        $this->belongsToMany('Achievements');
        $this->hasMany('Results');
    }
}