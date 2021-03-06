<div style="background-image: url(../img/bg.png); margin-right: 5%; margin-left: 5%">
    <div class="ui fluid container" style="background-image: url(../img/whitebg.png)" >
<div style="margin-left: 10%; margin-right: 10%">
<?php
echo '<br>';
echo $this->Form->create(
    $assoc,
    [
        'url'=>[
            'controller'=>'associations',
            'action'=>'register'
        ],
        'class'=>'ui form',
        'type' => 'file'
    ]
);

echo $this->Form->control(
    'nom',
    [
        'class'=>'ui input',
        'label'=>'Le nom de votre entreprise :',
        'maxlength'=>'100',
        'style'=>'margin-bottom:5px'
    ]
);


echo 'Décrivez votre activté en quelques mots:';
echo $this->Form->textarea(
    'description',
    [
        'class'=>'ui input',
        'maxlength'=>'800',
        'style'=>'height:150px ; margin-bottom:5px'
    ]
);

echo '<br>';
echo $this->Form->control(
  'website',
        [
            'class'=>'ui input',
            'label'=>'Site web de votre entreprise :',
            'maxlength'=>'100',
            'style'=>'margin-bottom:5px'
        ]
);
echo '</br>';

echo $this->Form->control(
    'domaine',
    [
        'class'=>'ui input',
        'label'=>'Dans quel domaine travaillez-vous ?',
        'maxlength'=>'50',
        'style'=>'margin-bottom:30px '
    ]
);

echo $this->Form->control(
    'mdp',
    [
        'class'=>'ui input',
        'label'=>'Votre mot de passe :',
        'type'=>'password',
        'maxlength'=>'64',
        'size'=>'15',
        'style'=>'margin-bottom:5px'
    ]
);

echo $this->Form->control(
    'confmdp',
    [
        'class'=>'ui input',
        'label'=>'Confirmez votre mot de passe :',
        'type'=>'password',
        'maxlength'=>'64',
        'size'=>'15',
        'style'=>'margin-bottom:20px'
    ]
);
?>
    <label>Photo de profil de votre entreprise :</label>
    <?php

  echo $this->Form->file('file');
  
echo $this->Form->button(
    '<p style="font-family: Oswald">Confirmer l\'inscription</p>',
    [
        'class'=>'ui black button'
    ]
);

echo  $this->Form->end();

echo '<br>';
?>
