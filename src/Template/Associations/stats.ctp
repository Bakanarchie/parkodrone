<div style="background-image: url(../../webroot/img/bg.png)">

<br>
<script>
    window.onload = function(){
        $('#barre').progress();
    }
</script>

<div style="display: flex; background-image: url(../../webroot/img/whitebg.png); margin-left: 1%; margin-right: 1%" >
    <div style="padding: 1%; margin-right: 5px">
        <?= $this->Html->image($assocActu->filename, ['class'=>'ui small image']); ?>
    </div>

    <div style="width:70%; padding: 1%">

        <div class="ui fluid container" style="horiz-align: left ; margin-top: 5px" >

            <div class=" fluid column" style="font-weight: bold; vertical-align: top; horiz-align: left; text-align:left ; font-size: 30px ; margin-top: 20px; font-family: Oswald">
                <?=$assocActu->nom?>
            </div>
            <div  style="text-align: left ; width: 200px ; font-size: 18px ;margin-top: 15px ;margin-left: 0px">
                <?= $assocActu->domaine ?>

            </div>
            <?php
            if(trim($assocActu->website) != ""){
                echo $this->Html->link('<br><button class="ui simple compact black button">Site web</button>', $assocActu->website, ['escape'=>false, 'target'=>'_blank']);
            } ?>
            <?php
            if($this->request->getSession()->read('isAdmin')){
                echo '<div class="ui simple black compact  button">
                                <div class="ui circular simple dropdown item">
                                    Outils administratifs <i class="dropdown icon"></i>
                                    <div class="ui inverted menu"style="margin-left:45px;margin-top: 3px">';
                if(!($assocActu->nom == "Park'O'Drone")){
                    echo '<div class="item">'.$this->Html->link('Bannir','/admin/ban/'.$assocActu->id, ['style'=>'color: black; margin-top:5px']).'</div>';
                }
                echo '<div class="item">Ajouter temps</div>';
                echo '<div class="item">'.$this->Html->link('Ajouter Score','/admin/ajouterscore/'.$assocActu->id,['style'=>'color: black']).'</div>';
                if(!($assocActu->nom == "Park'O'Drone")){
                    if($assocActu->groupe == "admin"){
                        echo '<div class="item">'.$this->Html->link('Rétrograder','/admin/retrograde/'.$assocActu->id,['style'=>'color: black']).'</div>';
                    }
                    else{
                        echo '<div class="item">'.$this->Html->link('Promouvoir','/admin/promote/'.$assocActu->id, ['style'=>'color: black'] ).'</div>';
                    }
                }
                echo '</div>
                                </div>
                            </div>';
            }
            ?>
        </div>
        <br>


    </div>
</div>

<br>
<div class="ui fluid unstackable container">

    <div class="ui fluid grid container" style="background-image: url(../img/whitebg.png)">
        <div class="two column row" >

            <table class="ui compact unstackable single line table">
                <thead>
                <tr>
                    <th colspan="4" ; style="background-color: #1a1a1a; background-image:url(../../webroot/img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DUELS</p></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        <p>Nombre de participations</p>
                        <p>Duels provoqués</p>
                        <p>Nombres de coopérations </p>
                        <p>Victoires</p>
                        <p>Points remportés</p>
                        <p>Taux de victoire</p>
                    </td>
                    <td>
                        <p>0</p>
                        <p>0</p>
                        <p>0</p>
                        <p>0</p>
                        <p>0000 PTS</p>
                        <p>00.0%</p>

                    </td>
                </tr>
                <tfoot class="full-width">
                <tr>
                    <td colspan="2">
                        <div class="ui grey progress" data-percent="65" id="barre">
                            <div class="bar">
                                <div class="progress"></div>
                            </div>
                            <div class="label">Taux de victoire</div>
                        </div>
                    </td>
                </tr>
                </tbody>
                </tfoot>
            </table>

            <table class="ui compact unstackable single line table">
                <thead>
                <tr>
                    <th colspan="4" ; style="background-color: #1a1a1a;background-image:url(../../webroot/img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">COMPÉTITIONS</p></th>
                </tr>
                </thead>
                <tr>
                    <td>
                        <p>Nombre de participations</p>
                        <p>Victoires</p>
                        <p>Podiums</p>
                        <p>Place moyenne</p>
                        <p>Points remportés</p>
                    </td>
                    <td>
                        <p>0</p>
                        <p>0</p>
                        <p>0</p>
                        <?php
if($assocActu->classement == 1)
    echo'<p>'.$assocActu->classement.'er</p>';
else
    echo'<p>'.$assocActu->classement.' ème</p>';
echo '<p>'.$assocActu->score.' PTS</p>';?>
                    </td>
                    <td>

                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>
<br>

