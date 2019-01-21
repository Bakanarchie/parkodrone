<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 21/01/2019
 * Time: 10:08
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class DuelsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->belongsToMany('Associations');
    }

}