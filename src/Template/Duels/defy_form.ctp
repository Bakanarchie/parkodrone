<div class="ui container">
    <div class="ui stackable grid container">

    </div>

    <?php

echo $this->Form->create(
    $newDefi,
    [
        'class'=>'ui form',
        'url'=>[
            'action'=>'defy'
        ]
    ]
);


echo $this->Form->control(
    'Duels.duelDate',
    [
        'class' => 'ui input',
        'lang' => 'fr'
    ]
);

echo $this->Form->control(
    'Duels.message',
    [
        'class' => 'ui input',
        'label' => 'Entrez un message pour votre adversaire'
    ]
);

echo $this->Form->hidden(
        'idAssoc2',
        [
            'value' => $id
        ]
);

echo $this->Form->submit(

);

echo $this->Form->end();

?>
</div>

