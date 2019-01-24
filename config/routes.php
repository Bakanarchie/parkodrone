<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    $routes->connect('/', ['controller' => 'Associations', 'action' => 'index']);
	$routes->connect('/connexion', ['controller'=>'Associations','action'=>'connect']);
    $routes->connect('/inscrireCompet/:idComp', ['controller' => 'Associations', 'action' => 'registerToComp']);
    $routes->connect('/profil/:id', ['controller' => 'Associations', 'action' => 'showProfile'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
		$routes->connect('/defier/:id', ['controller' => 'Duels', 'action' => 'defyForm'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/compet/:id', ['controller' => 'Competitions', 'action' => 'affichedetail'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/admin', ['controller'=>'Associations','action'=>'admin']);
    $routes->connect('/admin/ban/:id', ['controller' => 'Associations', 'action' => 'ban'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/admin/promote/:id', ['controller' => 'Associations', 'action' => 'promote'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/admin/retrograde/:id', ['controller' => 'Associations', 'action' => 'retrograde'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/admin/ajouterscore/:id', ['controller' => 'Associations', 'action' => 'addScoreForm'],
        [
            'pass'=>[
                'id'
            ],
            'id'=>'[0-9]+'
        ]);
    $routes->connect('/admin/createComp', ['controller' => 'Competitions', 'action' => 'createComp']);
    $routes->fallbacks(DashedRoute::class);
});
