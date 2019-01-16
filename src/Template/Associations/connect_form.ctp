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
            'action'=>'connect'
        ],
        'class'=>'ui form'
    ]
);

echo $this->Form->control(
    'Nom',
    [
        'class'=>'ui input',
        'label'=>'Votre Nom : ',
        'maxlength'=>'100'
    ]
);

echo $this->Form->control(
    'MDP',
    [
        'class'=>'ui input',
        'label'=>'Votre Mot de Passe : ',
        'type'=>'password',
        'maxlength'=>'64'
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
</div>
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
