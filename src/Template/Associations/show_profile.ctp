
<div class="ui container">
    <div class="ui fluid stackable grid container" style="background-color: #b9b9b9">
        <div class="two column row">
            <div class="ui four wide column" style="margin-left: auto">
                <?= $this->Html->image($assocActu->filename, ['class'=>'ui small image']); ?>
            </div>
            <div class="twelve wide column">
                <div class="ui fluid stackable grid container">
                    <div class="four column row">
                        <div class="column" style="font-weight: bold; text-align: center">
                           <?=$assocActu->nom?>
                        </div>
                        <div class="column" style="text-align: center">
                            <?= $assocActu->domaine ?>
                        </div>
                        <div class="column">

                        </div>
                        <div class="column" style="text-align: center">
                            <?php
                            if(trim($assocActu->website) != ""){
                                echo $this->Html->link('<button class="ui gray button">Site web</button>', $assocActu->website, ['escape'=>false, 'target'=>'_blank']);
                            }


                            ?>
                        </div>
                    </div>
                </div>

                <div class="row" style="text-align: center"><?= $assocActu->description ?></div>
            </div>
        </div>
    </div>
</div>
