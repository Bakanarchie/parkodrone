<div style="background-image: url(../img/bg.png); margin-right: 5%; margin-left: 5%">
<div class="ui fluid container" style="background-image: url(../img/whitebg.png)" >
<div class="ui container">
<br>
<style>
    #misenpage{
        font-size: large;

    }


</style>


    <div id="misenpage">
    <?php


echo $this->Form->create(
    $assoc,
    [
        'url'=>[
            'controller'=>'associations',
            'action'=>'connect'
        ],
        'class'=>'ui form'
    ]
);

echo $this->Form->control(
    'Nom',
    [
        'class'=>'ui input',
        'label'=>'Le nom de votre entreprise : ',
        'maxlength'=>'100',
        'style'=>'margin-bottom:10px'
    ]
);

echo $this->Form->control(
    'MDP',
    [
        'class'=>'ui input',
        'label'=>'Votre mot de passe : ',
        'type'=>'password',
        'maxlength'=>'64',
        'style'=>'margin-bottom:20px'
    ]
);

echo $this->Form->button(
  '<p style="font-family: Oswald">Vous connecter</p>',
  [
      'class'=>'ui black button'
  ]
);

echo  $this->Form->end();

?>



    <br>
    </div></div></div>