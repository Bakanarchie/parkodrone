<div class="ui container">

    <div class="ui fluid stackable grid container" >

        <div class="two column row" style="background-color: #b9b9b9">

            <div class="ui four wide column">
                <?= $this->Html->image($image->filename, ['style'=>'width:100%; height:auto;']); ?>
            </div>

            <div class="twelve wide column">
                <div class="ui fluid stackable grid container">

                        <div class="column">
                            <div style="font-weight: bold; text-align:left ; font-size: xx-large ; margin-top: 7px">
                                <?=$compet->NomCompetition?>
                            </div>
                            <div class="column">
                                <div>
                                    <i>
                                        <?=$compet->Lieu?>
                                    </i>

                                </div>

                                <div>
                                    <?=$compet->Description?>
                                </div>

                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>