<?php
/**
 * Created by PhpStorm.
 * User: Ayano
 * Date: 2/28/2019
 * Time: 9:58 AM
 */

namespace App\Model\Table;

use Cake\ORM\Table;

class StatisticsTable extends Table
{
    public function initialize(array $config){
        parent::initialize($config);
        $this->hasOne('Associations');
    }
}