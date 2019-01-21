
<div class="ui container">
    <div class="ui fluid stackable grid container" >
        <div class="two column row" style="background-color: #b9b9b9">
            <div class="ui four wide column">
                <?= $this->Html->image($assocActu->filename, ['style'=>'width:100%; height:auto;']); ?>
            </div>
            <div class="twelve wide column">
                <div class="ui fluid stackable grid container">



                    <div class="three column row">


                        <div class="column" style="font-weight: bold; text-align:left ; font-size: xx-large ; margin-top: 7px">
                            <?=$assocActu->nom?>
                        </div>


                        <div class="column">
                            <?php
                            if($this->request->getSession()->read('isAdmin')){
                                echo '<div class="ui compact small menu">
                                <div class="ui simple dropdown item">
                                    Outils administratifs
                                    <i class="dropdown icon"></i>
                                    <div class="menu">';
                                if(!($assocActu->nom == "Park'O'Drone")){
                                    echo '<div class="item">'.$this->Html->link('Bannir','/admin/ban/'.$assocActu->id, ['style'=>'color: black']).'</div>';
                                }
                                echo '<div class="item">Ajouter temps</div>
                                        <div class="item">Ajouter score</div>';
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

                        <div class="column" style="text-align: center">
                            <?php
                            if(trim($assocActu->website) != ""){
                                echo $this->Html->link('<button class="ui gray circular button">Site web</button>', $assocActu->website, ['escape'=>false, 'target'=>'_blank', 'style'=>'margin-top: 10px']);
                            } ?>
                        </div>

                    <div class="one column row">
                        <div class="column" style="text-align: left ; width: 200px ; margin-left: 3px">
                            <?= $assocActu->domaine ?>
                        </div>
                    </div>
                </div>

                <div class="row" style="text-align: justify;  "><?= $assocActu->description ?></div>
            </div>
        </div>


        </div>


        <br>
        <div class="two column row">
            <div class=" six wide column">
                <div class="inline" style="text-align:left ; width = auto">
                    <?php
                     echo '<p><span><t style="font-size:large"> Score total : </t>  <t style="font-size:xx-large ; font-weight:900">' , $assocActu->score ,'</t> <t style="font-size:large ; font-weight:100">( ', $assocActu->score ,' ème )</t></span></p>';

                    ?>
                </div>


                <table class="ui yellow celled table">
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

                    </div>
                    <table>

                    </table>
                    <table>

                    </table>
                </div>
            </div>
        </div>

</div>
