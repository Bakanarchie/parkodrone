<?php
$err = $this->Flash->render();

    if($err != null){
        $err = explode('>',$err);
        $err = explode('<',$err[1]);
        dd($err);
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

?>

<script>
    $('.message .close')
        .on('click', function() {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        })
    ;
</script>
