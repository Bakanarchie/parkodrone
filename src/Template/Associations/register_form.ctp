<div class="ui container">
<?php
$err = $this->Flash->render();

if($err != null){
    $err = explode('>',$err);
    $err = explode('<',$err[1]);
    $err[0] = utf8_encode($err[0]);
    echo '<div class="ui red message">
        <i class="close icon"></i>
        <div class="header">
            Il y a eu un problème lors de la connexion.
        </div>
        <p>'.$err[0].'</p>
    </div>';
}
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
    'Nom',
    [
        'class'=>'ui input',
        'label'=>'Nom de votre entreprise :',
        'maxlength'=>'100'
    ]
);



echo $this->Form->control(
    'Description',
    [
        'class'=>'ui input',
        'label'=>'Décrivez-vous en quelques mots :',
        'maxlength'=>'800'
    ]
);

echo $this->Form->control(
    'Domaine',
    [
        'class'=>'ui input',
        'label'=>'Dans quel domaine travaillez-vous ?',
        'maxlength'=>'50'
    ]
);

echo $this->Form->control(
    'MDP',
    [
        'class'=>'ui input',
        'label'=>'Votre Mot de Passe :',
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
