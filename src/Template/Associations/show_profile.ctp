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

                </div>
            </div>
        </div>

             <?php
             if($this->request->getSession()->read('isAdmin')){
             echo '<div class="ui simple inverted compact small menu">
                                <div class="ui circular simple dropdown item">
                                    Outils administratifs
                                    <div class="menu">';
            if(!($assocActu->nom == "Park'O'Drone")){
                echo '<div class="item">'.$this->Html->link('Bannir','/admin/ban/'.$assocActu->id, ['style'=>'color: black']).'</div>';
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

          <div class="row" style="text-align: justify ; margin-left: 3%;margin-right: 3% "><?= $assocActu->description ?></div>

    </div>







        <br><br>
    <div class="two column row">
            <div class=" eight wide column">
                <div class="inline" style="text-align:left ; width = auto">
                    <?php
                     echo '<p><span><t style="font-size:large"> Score total : </t>  <t style="font-size:xx-large ; font-weight:900; font-family: Oswald">' , $assocActu->score ,' pts</t> <t style="font-size:large ; font-weight:100;font-family: Oswald">( ', $assocActu->classement ,' ème )</t></span></p>';

                   ?>
                </div>


                <table class="ui celled table">
                    <thead>
                        <th>Derniers duels</th>
                    </thead>
                    <?php


                    ?>
                </table>
            </div>
             <div class=" eight wide column">
                <div class="ui stackable grid">
                    <div class="four column row">
                        <div class="column" style="text-align: right">
                        </div>
                        <div class="column" style="text-align: right">
                            <button class="ui rounded button">Statistiques</button>
                        </div>
                        <div class="column" style="text-align: right">
                            <?php if($assocActu->id != $this->request->getSession()->read('currUser') && $this->request->getSession()->read('currUser') != null) echo $this->Html->link('<button class="ui rounded button">Défier</button>','/defier/'.$assocActu->id,['escape'=>false]); ?>
                        </div>
                        <div class="column" style="text-align: right">
                            <button class="ui rounded button">
                                <div class="ui dropdown">
                                    Plus
                                    <i class="ui dropdown icon"></i>
                                    <div class="ui vertical divider"></div>
                                    <div class="menu">
                                        <div class="item">Toast</div>
                                    </div>
                                </div>
                            </button>

                        </div>
                    </div>
                    <table>

                    </table>
                    <table>

                    </table>
                </div>
            </div>
        </div>

</div>
    <br>
