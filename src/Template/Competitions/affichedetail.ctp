
<div class="ui fluid unstackable container">
    <div class="ui container">
        <?= $this->Html->link('<button class="ui black button">'."Retour à la page d'accueil".'</button>', '/', ['escape'=>false]) ?>
    </div>
    <div class="ui fluid unstackable grid container" style="background-image: url(../img/whitebg.png)">

        <div class="two column row" >

            <div class="four wide compact column">
                <?= $this->Html->image($compet->Image, ['class'=>'ui small image']); ?>
            </div>


            <div class=" compact ten wide column" style="horiz-align: left">

                <div class="ui fluid container" style="horiz-align: left ; margin-top: 5px" >

                    <div class=" fluid column" style="font-weight: bold; vertical-align: top; horiz-align: left; text-align:left ; font-size: x-large ; ; font-family: Oswald">
                        <?=$compet->NomCompetition?>
                    </div>
                    <div  style="text-align: left ; width: 200px ; margin-top: 10px ;margin-left: 0px">
                        <?= $compet->Lieu ?>

                    </div>


                </div>
            </div>
        </div>

        <div class="row" style="text-align: justify ; margin-left: 3%;margin-right: 3% ; margin-bottom: 15px"><?= $compet->Description ?></div>

    </div>
</div>