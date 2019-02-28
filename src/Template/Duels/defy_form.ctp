
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
        <div class="ui container">
            <?= $this->Html->link('<button class="ui black button">'."Retour à la page d'accueil".'</button>', '/', ['escape'=>false]) ?>
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


        ?>
            <br/>
            <div>
                <label>Sélectionnez une date :</label>
                <table id="calendar">
                    <colgroup span="7"></colgroup>
                    <tr>
                        <th colspan="7" id="head">
                            <button id="prev" class="ui white button">⬅</button>
                            <h1 id="currMonth"></h1>
                            <button id="next" class="ui white button">➡</button>
                        </th>
                    </tr>
                    <tr>
                        <td class="day">
                            Lun
                        </td>
                        <td class="day">
                            Mar
                        </td>
                        <td class="day">
                            Mer
                        </td>
                        <td class="day">
                            Jeu
                        </td>
                        <td class="day">
                            Ven
                        </td>
                        <td class="day">
                            Sam
                        </td>
                        <td class="day">
                            Dim
                        </td>
                    </tr>
                    <tr id="line1">

                    </tr>
                    <tr id="line2">

                    </tr>
                    <tr id="line3">

                    </tr>
                    <tr id="line4">

                    </tr>
                    <tr id="line5">

                    </tr>
                    <tr id="line6">

                    </tr>
                </table>
                <p id="displayDate"></p>
                <input type="hidden" id="inputDate" name="DateCompet">
            </div>





            <br/>
    <?php
        echo $this->Form->control(
            'Duels.message',
            [
                'class' => 'ui input',
                'label' => 'Votre message :'

            ]
        );
        echo $this->Form->submit('DEFIER !', ['class'=>"ui black button fluid", 'style'=>'font-family: Oswald;font-size: x-large']);
        echo $this->Form->end();
        ?>
        </div>
    </div>
</div>

<?php echo $this->Html->script("script.js") ?>
<?= $this->Html->css('calendar.css') ?>



