<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 23/01/2019
 * Time: 12:12
 */

namespace App\Model\Table;


use Cake\ORM\Table;

class ResultsTable extends Table
{

    public function initialize(array $config)
    {
        parent::initialize($config);
        $this->hasOne('Associations');
    }

}