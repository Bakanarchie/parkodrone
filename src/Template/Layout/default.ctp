<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Park\'o\'Drone : Site Communautaire';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('../semantic/semantic.css') ?>
    <?= $this->Html->css('addition.css') ?>
    <?= $this->Html->script('../semantic/semantic.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="ui fluid inverted menu" data-topbar role="navigation">
            <div class="ui  four column stackable grid">
                <div class="one wide column"></div>
                <div class=" two wide column">
                    <?= $this->Html->link($this->Html->image('Park\'o\'Drone.png', ['class'=>'ui small image', 'alt'=>'Logo du site']),'/',['escape'=>false, 'class'=>'ui center aligned ']) ?>
                </div>
                <div class="six wide column">
                    <?= $this->Form->create(null, ['url'=>['controller'=>'associations', 'action'=>'search'], 'class'=>'ui fluid action input']) ?>
                    <input class="ui action input" placeholder="Rechercher une association, une compétition...">
                    <button class="ui gray button icon"><i class="search icon"></i></button>
                    <?= $this->Form->end(); ?>
                </div>
                <div class=" three wide column">
                    <?php
                    if($this->request->getSession()->read('currUser') != null){
                        echo $this->Html->link('<button class="ui black button">Votre Profil</button>', ['controller'=>'associations', 'action'=>'showProfile'], ['escape'=>false]);
                    }
                    else{
                        echo $this->Html->link('<button class="ui black button">Vous Connecter</button>', ['controller'=>'associations', 'action'=>'connectForm'], ['escape'=>false]);
                    }

                    ?>
                </div>
                <div class="three wide column">
                    <?php
                    if($this->request->getSession()->read('currUser') != null){
                        echo $this->Html->link('<button class="ui black button">Vous Déconnecter</button>', ['controller'=>'associations', 'action'=>'disconnect'], ['escape'=>false]);
                    }
                    else{
                        echo $this->Html->link('<button class="ui black button">Vous Inscrire</button>', ['controller'=>'associations', 'action'=>'registerForm'], ['escape'=>false]);
                    }
                    ?>
                </div>
            </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="ui container">
        <?= $this->fetch('content') ?>
    </div>
    <footer>
    </footer>
</body>
</html>
