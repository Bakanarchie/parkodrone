<br>
<div class="ui fluid unstackable container">


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
                    <br>
                    <?php
                    if($this->request->getSession()->read('isAdmin')){
                        echo '<div class="ui simple inverted compact small menu">
                                <div class="ui circular simple dropdown item">
                                    Outils administratifs
                                    <div class="menu"style="margin-top: 10px">';
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
            </div>
        </div>



          <div class="row" style="text-align: justify ; margin-left: 3%;margin-right: 3% "><?= $assocActu->description ?></div>

    </div><br>

    <br>
            <div class="ui stackable two column grid" style="margin-left: 4%; margin-right: 4%">
                <div class="ui seven wide column">

                    <div class="unstackable round container" style="height: auto; width: auto; vertical-align: center;text-align: center; background-image:  url(../img/whitebg.png)">
                        <br>
                        <?php
                        if($assocActu->classement == 1){
                            echo '<span><t style="font-size:large ;margin-top: 15px margin-bottom: 15px"> Score total : </t>  <t style="font-size:xx-large ; font-weight:900; font-family: Oswald; margin-bottom: 10px;">' , $assocActu->score ,' pts</t> <t style="font-size:x-large ; font-weight:100;font-family: Oswald">(', $assocActu->classement ,' er )</t></span>';
                        }
                        else if($assocActu->classement != 1){
                            echo '<span><t style="font-size:large ;margin-top: 15px margin-bottom: 15px"> Score total : </t>  <t style="font-size:xx-large ; font-weight:900; font-family: Oswald; margin-bottom: 10px;">' , $assocActu->score ,' pts</t> <t style="font-size:x-large ; font-weight:100;font-family: Oswald">(', $assocActu->classement ,' ème )</t></span>';
                        }
                        ?>

                        <div class="grid mobile only"> <br> </div>
                        <button class="ui black rounded button" style="margin-left: 10px">Statistiques</button>
                        <?php if($assocActu->id != $this->request->getSession()->read('currUser') && $this->request->getSession()->read('currUser') != null) echo $this->Html->link('<button class="ui black rounded button">Défier</button>','/defier/'.$assocActu->id,['escape'=>false]); ?>
                    <br><br>
                    </div>
                    <br>




                        <div class="inline" style="text-align:left ; width = auto">
                             <table class="ui  selectable compact unstackable single line table" >
                                 <thead >
                                 <tr style="background-image:url(../img/banner.png)">
                                 <th colspan="4" ; style="background-image:url(../img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DERNIERS DUELS</p></th>
                                 </tr>
                                 </thead >

                                 <tbody>
                                 <?php
                                 if(isset($duelResults)){
                                     foreach($duelResults as $resultTemp){
                                         $enemy = $this->Associations->Duels->get($resultTemp->idDuel)->contain(['Associations']);
                                         foreach($enemy->associations as $assocTemp){
                                             if($assocTemp->id != $assocActu->id) $enemy = $assocTemp;
                                         }
                                         echo '<tr><td><div class="ui row">';
                                         echo $enemy->nom;
                                         echo '</div></td></tr>';
                                     }
                                 }
                                 else{
                                     echo '<tr><td>Rien à afficher pour le moment </td></tr>';
                                 }

                                 ?>
                                 </tbody>
                             </table>

                        </div>
                    </div>

                    <div class="ui nine wide column">
                        <table class="ui fixed table " >
                            <thead>
                            <tr style="background-image:url(../img/banner.png)">
                                <th colspan="1" ; style="background-image:url(../img/banner.png)"> <p style="font-size:large; font-family: Oswald, sans-serif ;width: 100%; color:#fefeff"> TROPHÉES </p> </th>
                            </tr>
                            </thead>
                            <th class="column" style="overflow-x:scroll; width:150px">
                            <div >

                                Not supported yet.

                            </div></th>

                        </table>


                        <table class="ui  selectable compact unstackable single line table" style="width: 100%">
                            <thead >
                            <tr style="background-image:url(../img/banner.png)">
                                <th colspan="4" ; style="background-image:url(../img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DERNIÈRES COMPÉTITIONS</p></th>
                            </tr>
                            </thead >
                            <tr><td>Not supported yet.</td></tr>
                        </table>

                    </div>

                </div>
    <br>
    </div>

