<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 23/01/2019
 * Time: 11:40
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class AlliancesTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config); // TODO: Change the autogenerated stub
        $this->belongsToMany('Duels');
    }

}