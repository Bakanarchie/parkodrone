<div class="ui container">
<?php
echo $this->Form->create(
    $assoc,
    [
        'url'=>[
            'controller'=>'associations',
            'action'=>'register'
        ],
        'class'=>'ui form'
    ]
);

echo $this->Form->control(
    'nom',
    [
        'class'=>'ui input',
        'label'=>'Nom de votre entreprise :',
        'maxlength'=>'100'
    ]
);



echo $this->Form->control(
    'description',
    [
        'class'=>'ui input',
        'label'=>'Décrivez-vous en quelques mots :',
        'maxlength'=>'800'
    ]
);

echo $this->Form->control(
    'domaine',
    [
        'class'=>'ui input',
        'label'=>'Dans quel domaine travaillez-vous ?',
        'maxlength'=>'50'
    ]
);

echo $this->Form->control(
    'mdp',
    [
        'class'=>'ui input',
        'label'=>'Votre Mot de Passe :',
        'type'=>'password',
        'maxlength'=>'64'
    ]
);

echo $this->Form->control(
    'website',
    [
        'class'=>'ui input',
        'label'=>'Site Web de votre Entreprise :',
        'type'=>'password',
        'maxlength'=>'64'
    ]
);

echo $this->Form->control(
    'confmdp',
    [
        'class'=>'ui input',
        'label'=>'Confirmez votre mot de passe :',
        'type'=>'password',
        'maxlength'=>'64'
    ]
);

echo $this->Form->button(
    'Confirmer l\'inscription',
    [
        'class'=>'ui black button'
    ]
);

echo  $this->Form->end();

?>
</div>
