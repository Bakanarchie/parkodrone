<br>
<script>
    window.onload(){
        $('#Ratio').progress({
            percent: 65
        });
    }
</script>
    <div class="ui fluid unstackable container">

    <div class="ui fluid grid container">
        <?= $this->Html->link('<button class="ui black button">'."Retour à la page d'accueil".'</button>', '/', ['escape'=>false]) ?>
    </div>


    <div class="ui fluid grid container" style="background-image: url(../img/whitebg.png)">
        <div class="two column row" >
            
            <div class="five wide compact column">
                <?= $this->Html->image($assocActu->filename, ['class'=>'ui small image']); ?>
            </div>


            <div class=" compact column" style="horiz-align: left">

                <div class="ui fluid container" style="horiz-align: left ; margin-top: 5px" >

                    <div class=" fluid column" style="font-weight: bold; vertical-align: top; horiz-align: left; text-align:left ; font-size: x-large ; ; font-family: Oswald">
                        <?=$assocActu->nom?>
                    </div>
                    <div  style="text-align: left ; width: 200px ; margin-top: 10px ;margin-left: 0px">
                        <?= $assocActu->domaine ?>

                    </div>
                    <?php
                    if(trim($assocActu->website) != ""){
                        echo $this->Html->link('<br><button class="ui simple compact black button">Site web</button>', $assocActu->website, ['escape'=>false, 'target'=>'_blank']);
                    } ?>

                </div>

            </div>
            <table class="ui  selectable compact unstackable single line table">
                <thead>
                <tr style="background-image:url(img/banner.png)">
                    <th colspan="4" ; style="background-color: #1a1a1a"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DUELS</p></th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <p>Nombre de participation</p>
                        <p>Duels provoqués</p>
                        <p>Ratio de victoire</p>
                        <p>Points emportés total</p>
                    </td>
                    <td>
                        <p>0</p>
                        <p>0</p>
                        <p>00.0%</p>
                        <p>0000 PTS</p>
                    </td>
                    <td>
                        <p>Victoires / Défaites</p>
                        <div class="ui progress" id="Ratio">
                            <div class="bar">
                                <div class="progress"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <table class="ui  selectable compact unstackable single line table">
                <thead>
                <tr style="background-image:url(img/banner.png)">
                    <th colspan="4" ; style="background-color: #1a1a1a"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">COMPETITIONS</p></th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <p>Nombre de participation</p>
                        <p>Premières places</p>
                        <p>Podiums</p>
                        <p>Place moyenne</p>
                        <p>Points emportés total</p>
                    </td>
                    <td>
                        <p>0</p>
                        <p>0</p>
                        <p>0</p>
                        <p>X ème</p>
                        <p>0000 PTS</p>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
        </div>

</div>
<br>