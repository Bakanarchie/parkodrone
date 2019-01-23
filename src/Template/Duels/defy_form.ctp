
<div  class="fluid container" style="background-image: url(../img/whitebg.png)">
<div  class="fluid container" style="width: 100% ; height: auto; background-image: url(../img/whoosh.gif); background-size: 100% 100%; margin-bottom: 5%; margin-top: 14px">




        <div class="ui grid container">

            <div class="ui six wide column" style="vertical-align: center">
                <div class="ui fluid  image" style ="height: 90%; vertical-align: center"> <img src="../img/<?=$assactu->filename?>">  </div>

            </div>

            <div class="ui four wide column"></div>

            <div class="ui six wide right-align column">
                <div class="ui fluid image" style ="height: 90%;"> <img src="../img/<?=$association->filename?>">  </div>

            </div>

        </div>
        <div class="ui  unstackable grid table" style="background-color: #0f0f10; opacity: 0.8">

            <div class="ui eight wide column">

                <p style="color:white; text-align: left; font-size: x-large; font-family: Oswald; margin-left: 10%; opacity: 1.2"><?=$assactu->nom?>
                    <br><?=$assactu->score?> pts</p>
            </div>


            <div class="ui eight wide column">
                <p style="color:white; text-align: right; font-size: x-large; font-family:Oswald;margin-right: 10%; opacity: 1.2"><?=$association->nom?>
                    <br><?=$association->score?> pts</p>
            </div>

        </div>



    <div class="row">
        <div class="ui black button  fluid" >
            <p style="font-family: Oswald;font-size: 5">COMPARER LES DEUX CAMPS</p>
        </div>
    </div>
    <div class="container yellow fluid " style="background-color: #fff600 ; height: 5px"></div>
</div>


    <div class="ui fluid container">

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
        echo $this->Form->hidden(
            'idAssoc2',
            [
                'value' => $id
            ]
        );
        echo $this->Form->control(
            'Duels.duelDate',
            [
                'class' => 'ui fluid input',
                'type' => 'date',
                'lang' => 'fr',
                'dateFormat' => 'DMY',
                'minYear' => date('Y'),
                'maxYear' => date('Y') + 5,
            ]
        );
        echo $this->Form->control(
            'Duels.message',
            [
                'class' => 'ui input',

            ]
        );
        echo'<div class="row">
                                <div class="ui black button  fluid" >
                                    <p style="font-family: Oswald;font-size: x-large">
                                    DEFIER !</p>
                                </div>
                           </div>';
        echo $this->Form->submit();
        echo $this->Form->end();
        ?>
    </div>
</div>



