<br>
<div class="ui fluid unstackable container" >
        <div style="display: flex; background-image: url(../img/whitebg.png); margin-left: 1%; margin-right: 1%" >
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
    <div class="desc" style="text-align: justify ;font-size: 20px;padding: 3%"><?= $assocActu->description ?></div>
    <style>
        @media (max-width: 1500px) {
            .desc{
                font-size: 60px;
            }
        }
    </style>



            <div class="ui stackable compact two column grid" style="padding: 1%">

                <div class="ui six wide column">

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
                        <?php echo $this->Html->link('Statistiques', '/associations/stats/'.$assocActu->id, ['class'=>'ui black rounded button', 'style'=>'margin-left: 10px']);
                        if($assocActu->id != $this->request->getSession()->read('currUser') && $this->request->getSession()->read('currUser') != null) echo $this->Html->link('<button class="ui black rounded button">Défier</button>','/defier/'.$assocActu->id,['escape'=>false]); ?>
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

                            <table class="ui  selectable compact unstackable single line table" style="width: 100%">
                                <thead >
                                <tr style="background-image:url(../img/banner.png)">
                                    <th colspan="4" ; style="background-image:url(../img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DERNIÈRES COMPÉTITIONS</p></th>
                                </tr>
                                </thead >
                                <tr><td>Cette fonctionnalité n'est pas encore prise en charge.</td></tr>
                            </table>


                        </div>
                    </div>

                <div class="ui ten wide column " >
                        <table class="ui fixed table">
                            <thead>
                            <tr style="background-image:url(../img/banner.png)">
                                <th colspan="1" ; style="background-image:url(../img/banner.png)"> <p style="font-size:large; font-family: Oswald, sans-serif ;width: 100%; color:#fefeff"> TROPHÉES </p> </th>
                            </tr>
                            </thead>
                            <th >

                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach1.0.png"  style="width:16.6%" data-title="We are the champions!"      data-content="Remporter sa première course"                                   data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach2.1.png"  style="width:16.6%" data-title="Je te choisis!"             data-content="Coopérer avec une autre équipe pour la première fois"                                     data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach3.1.png"  style="width:16.6%" data-title="Le pouvoir de l'amitié"     data-content="Coopérer avec une autre équipe 10 fois"                                                   data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach4.1.png"  style="width:16.6%" data-title="L'ange gardien de la route" data-content="Coopérer avec une autre équipe 50 fois"                                                   data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach5.0.png"  style="width:16.6%" data-title="L'heure du du-du-du-duel !" data-content="Provoquer ou accepter son premier duel"                         data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach6.1.png"  style="width:16.6%" data-title="Fallait pas me doubler !"   data-content="Provoquer ou accepter 10 duels"                                 data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach7.1.png"  style="width:16.6%" data-title="Tête brulée"                data-content="Provoquer ou accepter 50 duels"                                 data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach8.0.png"  style="width:16.6%" data-title="Premier pas"                data-content="Participer à sa première compétition"                           data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach9.0.png"  style="width:16.6%" data-title="Fous du volant"             data-content="Participer à 10 compétitions"                                   data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach10.1.png" style="width:16.6%" data-title="Accros au bitume"           data-content="Participer à 50 compétitions"                                   data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach11.1.png" style="width:16.6%" data-title="Rentrer dans l'histoire"    data-content="Avoir été premier du classement général, la récompense ultime!" data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach12.0.png" style="width:16.6%" data-title="Conducteur Débutant"        data-content="Obtenir un total de 1000 points"                                data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach13.1.png" style="width:16.6%" data-title="Pilote Confirmé"            data-content="Obtenir un total de 5000 points"                                data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach14.1.png" style="width:16.6%" data-title="As du volant"               data-content="Obtenir un total de 25000 points"                               data-variation="basic"></div>
                                <div class="pop" ><img class="ui centered floated image pop" src="../img/achievements/ach15.0.png" style="width:16.6%" data-title="Battu à son propre jeu"     data-content="Battre Park'o'Drone lors d'une course"                          data-variation="basic"></div>


                            </th>
                            <script type="application/javascript">
                                $('.pop')
                                    .popup({
                                        position : 'top left',
                                    });
                            </script>
                        </table>




                    </div>

                </div>
    <br>
    </div>

