<div class="ui container">
    <?php
        echo $this->Form->create(
            $newCompetition,
            [
                    'url'=>[
                'controller'=>'competition',
                'action'=>'saveNewComp'],
                    'class'=>'ui form'
            ]
        );

        echo $this->Form->control(
            'NomCompetition',
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
    echo $this->Form->control(
      'Description',
      [
              'class'=>'ui input',
              'label'=>'Description de la compétition : '
      ]
    );

        echo $this->Form->end();
    ?>
</div>