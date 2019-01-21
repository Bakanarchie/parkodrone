<div class="ui container">
    <?php
        echo $this->Form->create(
            $newCompetition,
            ['class'=>'ui form']
        );

        echo $this->Form->control(
            'NomCompet',
            [
                'class'=>'ui input',
                'label'=>'Nom de la compétition : '
            ]
        );
    echo $this->Form->control(
        'DateCompet',
        [
            'class'=>'ui input',
            'label'=>'Date de la compétition (format AAAA-MM-JJ) : '
        ]
    );
    echo $this->Form->control(
        'Lieu',
        [
            'class'=>'ui input',
            'label'=>'Lieu de la compétition : '
        ]
    );

        echo $this->Form->end();
    ?>
</div>