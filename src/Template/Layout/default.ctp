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
        <?= $cakeDescription ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css') ?>
    <?= $this->Html->css('addition.css') ?>
    <?= $this->Html->script("https://code.jquery.com/jquery-3.2.1.min.js") ?>
    <?= $this->Html->script('https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.js') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <div class="ui three item grey stackable container inverted secondary menu">
        <div class="item">
            <?= $this->Html->link($this->Html->image('Park\'o\'Drone.png', ['class'=>'ui small image', 'alt'=>'Logo du site']),'/',['escape'=>false, 'class'=>'ui center aligned']) ?>
        </div>
        <div class="item">
            <?= $this->Form->create(null, ['url'=>['controller'=>'associations', 'action'=>'search'], 'class'=>'ui fluid action input']) ?>
            <input class="ui action input" placeholder="Rechercher une association, une compétition..." name="content">
            <button class="ui gray button icon"><i class="search icon"></i></button>
            <?= $this->Form->end(); ?>
        </div>
        <div class="item">
                <?php
                if($this->request->getSession()->read('currUser') != null){
                    echo $this->Html->link('<button class="ui white button">Votre Profil</button>', ['/profil/'.$this->request->getSession()->read('currUser')], ['escape'=>false]);
                    echo $this->Html->link('<button class="ui white button">Vous Déconnecter</button>', ['controller'=>'associations', 'action'=>'disconnect'], ['escape'=>false]);
                }
                else{
                    echo $this->Html->link('<button class="ui white button">Vous Connecter</button>', ['controller'=>'associations', 'action'=>'connectForm'], ['escape'=>false]);
                    echo $this->Html->link('<button class="ui white button">Vous Inscrire</button>', ['controller'=>'associations', 'action'=>'registerForm'], ['escape'=>false]);
                }

                ?>
        </div>
    </div>

    <div>
        <?= $this->fetch('content') ?>




    </div>
    <footer>
    </footer>
</body>
</html>
