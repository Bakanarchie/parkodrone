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
        'lang' => 'fr',
        'dateFormat' => 'YMD',
        'minYear' => date('Y'),
        'maxYear' => date('Y') + 5,
    ]
);

echo $this->Form->control(
    'Duels.message',
    [
        'class' => 'ui input',
        'label' => 'Entrez un message pour votre adversaire'
    ]
);

    echo '<div class="ui search">';

        echo $this->Form->control(
            'ally',
            [
                'class' => 'ui prompt input',
                'label' => '',
                'placeholder'=>'Faire appel à un allié'
            ]
        );
       echo' <div class="results"></div>
    </div>'
?>
    <script>



        var content = <?= $jsonString ?>
        ;

        console.log(content);
        $('.ui.search')
            .search({
                source : content,
                searchFields   : [
                    'title'
                ],
                fullTextSearch: false
            })
        ;
    </script>

    <?php
echo $this->Form->hidden(
        'idAssoc2',
        [
            'value' => $id
        ]
);
            ]
        );
        echo $this->Form->submit('DEFIER !', ['class'=>"ui black button fluid", 'style'=>'font-family: Oswald;font-size: x-large']);
        echo $this->Form->end();
        ?>
    </div>
</div>

echo $this->Form->end();

?>
</div>

