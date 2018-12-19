<?php
echo '<p style="color:red">'.$this->Flash->render().'</p>';
echo $this->Form->create(
    $assoc,
    [
        'url'=>[
            'controller'=>'associations',
            'action'=>'register'
        ]
    ]
);

echo $this->Form->control(
    'Nom',
    [
        'class'=>'ui input',
        'label'=>'Nom de votre entreprise :'
    ]
);



echo $this->Form->control(
    'Description',
    [
        'class'=>'ui input',
        'label'=>'Décrivez-vous en quelques mots :'
    ]
);

echo $this->Form->control(
    'Domaine',
    [
        'class'=>'ui input',
        'label'=>'Dans quel domaine travaillez-vous ?'
    ]
);

echo $this->Form->control(
    'MDP',
    [
        'class'=>'ui input',
        'label'=>'Votre Mot de Passe :',
        'type'=>'password'
    ]
);

echo $this->Form->button(
    'Confirmer l\'inscription',
    [
        'class'=>'ui black button'
    ]
);

echo  $this->Form->end();