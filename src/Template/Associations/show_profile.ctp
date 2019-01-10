
<div class="ui container">
    <div class="ui fluid grid container" style="background-color: #b9b9b9">
        <div class="two column row">
            <div class=" four wide column" >
                <?= $this->Html->image($assocActu->filename, ['class'=>'ui medium image']); ?>
            </div>
            <div class="column">
                <div class="ui fluid grid container">
                    <div class="four column row">
                        <div class="column" style="font-weight: bold">
                           <?=$assocActu->nom?>
                        </div>
                        <div class="column">
                            <?= $assocActu->domaine ?>
                        </div>
                        <div class="column">

                        </div>
                        <div class="column">
                            <?php
                            if($assocActu->website)
                                $this->Html->link('<button class="ui gray button"></button>', '', ['escape'=>false]);

                            ?>
                        </div>
                    </div>
                </div>

                <div class="row" style="color:black"><?= $assocActu->description ?></div>
            </div>
        </div>
    </div>
</div>
