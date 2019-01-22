<div class="ui container">
<?php
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
        'label'=>'Nom de votre entreprise :',
        'maxlength'=>'100',
        'style'=>'margin-bottom:5px'
    ]
);


echo 'Décrivez votre activté en quelques mots:';
echo $this->Form->textarea(
    'description',
    [
        'class'=>'ui input',
        'label'=>'Décrivez-vous en quelques mots :',
        'maxlength'=>'800',
        'style'=>'height:150px ; margin-bottom:5px'
    ]
);

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
        'label'=>'Votre Mot de Passe :',
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
 echo '<br>';
  echo 'Veuillez uploader la photo de votre entreprise:';
  echo $this->Form->file('file', ['label'=>'Logo de votre entreprise :']);
  
  echo '<br>';
echo $this->Form->button(
    'Confirmer l\'inscription',
    [
        'class'=>'ui black button'
    ]
);

echo  $this->Form->end();

?>
</div>
