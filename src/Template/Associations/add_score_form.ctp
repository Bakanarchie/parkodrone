<div style="background-image: url(../../webroot/img/bg.png); padding: 10px">

    <h1 style="background-image: url(../../webroot/img/whitebg.png); padding: 10px"> Score actuel:
        <?php echo $toEdit->score?></h1>
    <?php
        echo $this->Form->create($toEdit,['class'=>'ui form', 'url'=>['action'=>'addScore']]);
        echo $this->Form->control('Associations.score', ['class'=>'ui input']);
        echo $this->Form->hidden('id', ['value'=>$toEdit->id]);
        echo $this->Form->submit('Valider', ['class'=>'ui black button']);
        echo $this->Form->end();
    ?>
</div>