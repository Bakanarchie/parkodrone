<div class="ui container">
    <?php
    echo $this->Form->create(
        $competition,
        [
            'url'=>[
                'controller'=>'competitions',
                'action'=>'editCompet'],
            'class'=>'ui form',
            'type' => 'file'
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
            'label'=>'Date de la compétition (format AAAA-MoMo-JJ-HH-MiMi) : '
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

    echo '<br>';
    echo 'Ajoutez une image pour la compétition : ';
    echo $this->Form->file('file', ['Image pour la compétition']);
    echo '</br>';

    echo $this->Form->button(
        'Confirmer la création de la compétition',
        [
            'class'=>'ui black button'
        ]
    );
    echo $this->Form->end();
    ?>
</div>
