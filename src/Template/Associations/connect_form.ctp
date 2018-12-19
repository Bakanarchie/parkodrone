<p style="color:red"><?= $this->Flash->render(); ?></p>

<?php

echo $this->Form->create(
    $assoc,
    [
        'url'=>[
            'controller'=>'associations',
            'action'=>'connect'
        ]
    ]
);

echo $this->Form->control(
    'Nom',
    [
        'class'=>'ui input',
        'label'=>'Votre Nom : '
    ]
);

echo $this->Form->control(
    'MDP',
    [
        'class'=>'ui input',
        'label'=>'Votre Mot de Passe : ',
        'type'=>'password'
    ]
);

echo $this->Form->button(
  'Vous connecter',
  [
      'class'=>'ui black button'
  ]
);

echo  $this->Form->end();