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
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <?= $this->fetch('charset') ?>


</head>
<style>
    @font-face {
        font-family: Oswald; src: url('font/Oswald-Regular.ttf');
    }

</style>
<body style="margin-top: 0px ; background-image: url(../img/bg.png)" >
    <div class="ui vertically fitted three item  stackable compact inverted secondary menu" style="background-color: #101011 ; margin-bottom: 0px; ">
        <div class="item one column wide" >
            <?= $this->Html->link($this->Html->image('logo.png', ['class'=>'ui image', 'style'=>'height:60px ; width:270px', 'alt'=>'Logo du site']),'/',['escape'=>false]) ?>
        </div>
        <div class="item four column wide">
            <?= $this->Form->create(null, ['url'=>['controller'=>'associations', 'action'=>'search'], 'class'=>'ui fluid action input', 'style'=>'margin-bottom:3px']) ?>
            <input class="ui action input" placeholder="Rechercher une entreprise, une compétition..."  name="content">
            <button class="ui gray button icon"><i class="search icon"></i></button>
            <?= $this->Form->end(); ?>
        </div>
        <div  class="item fluid eight column wide" style="background-color: #101011 ; border-color: #101011 ; margin-bottom: 5px ; vertical-align: top; margin-left: 10px" >
                <?php

                if($this->request->getSession()->read('currUser') != null){
                    echo $this->Html->link('<button class="ui compact inverted basic yellow button" style="color: white ;background-color: #101011 ;font-family: Oswald; border-color: #101011">VOTRE PROFIL</button>', '/profil/'.$this->request->getSession()->read('currUser'), ['escape'=>false]);
                    echo $this->Html->link('<button class="ui compact inverted basic yellow button" style="color: white  margin-left: 10px ;background-color: #101011 ;font-family: Oswald; border-color: #101011">VOS DUELS</button>',  ['controller'=>'duels', 'action'=>'viewAll'], ['escape'=>false]);
                    echo $this->Html->link('<button class="ui compact inverted basic yellow button" style="color: white  margin-left: 10px ;background-color: #101011 ;font-family: Oswald; border-color: #101011">VOUS DECONNECTER</button>', ['controller'=>'associations', 'action'=>'disconnect'], ['escape'=>false]);

                }
                else{
                    echo $this->Html->link('<button class="ui compact inverted basic yellow  button" ; style="font-family: Oswald;">VOUS CONNECTER</button>', ['controller'=>'associations', 'action'=>'connectForm'], ['escape'=>false]);
                    echo $this->Html->link('<button class="ui compact inverted basic yellow button" style="margin-left: 10px; font-family: Oswald;">VOUS INSCRIRE</button>', ['controller'=>'associations', 'action'=>'registerForm'], ['escape'=>false]);
                }

                ?>
        </div>
    </div>

    <?php
    if($this->request->getSession()->read('isAdmin') == 1){
        echo '<div style="background-color: #101011 ; border-color: #101011 ; vertical-align: top; padding: 5px">';
        echo $this->Html->link('<button class="ui compact  fluid inverted basic yellow button" style="color: white ;background-color: #101011 ;font-family: Oswald; border-color: #101011">PANEL ADMINISTRATEUR</button>', '/admin/', ['escape'=>false]);
        echo '</div>';
    }
    ?>


    <div>
        <div class="ui container">
            <?php
            $err = $this->Flash->render();

            if($err != null){
                $err = explode('>',$err);
                $err = explode('<',$err[1]);
                $err[0]=mb_convert_encoding($err[0],"UTF-8","auto");
                echo '<div class="ui red message">
                <i class="close icon"></i>
                <div class="header">
                    Un problème a été rencontré ! :(
                </div>
                <p>'.$err[0].'</p>
            </div>';
            } ?>
        </div>
         <div class="container yellow fluid" style="background-color: #fff600 ; height: 5px"></div>
            <?= $this->fetch('content') ?>
    </div>






    <footer>
        <div style="background-color: #101011 ;height: 50px">

        </div>
    </footer>
    <script>
        $(document).ready(function () {
           window.setInterval(toto, 1000);
        });
    </script>
<script>
    function toto(){
        var temp = '<?= $this->request->getParam('_csrfToken'); ?>';
        $.ajax({
            url: '<?= $this->Url->build(['controller'=>'Associations', 'action'=>'checkdb']) ?>',
            beforeSend: function(xhr){
                xhr.setRequestHeader('X-CSRF-Token', temp);
            },
            type: 'post',
            success: function (response) {
                console.log(response);
            },
            error: function (response) {
                console.log(response);
            }
        })
    }

</script>
</body>
</html>
