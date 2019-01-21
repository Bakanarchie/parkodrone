
<div class="ui container">
    <div class="ui fluid stackable grid container" >
        <div class="two column row" style="background-color: #b9b9b9">
            <div class="ui four wide column" style="margin-left: auto">
                <?= $this->Html->image($assocActu->filename, ['class'=>'ui small image']); ?>
            </div>
            <div class="twelve wide column">
                <div class="ui fluid stackable grid container">
                    <div class="four column row">
                        <div class="column" style="font-weight: bold; text-align: center">
                           <?=$assocActu->nom?>
                        </div>
                        <div class="column" style="text-align: center">
                            <?= $assocActu->domaine ?>
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
                                    echo $this->Html->link('Bannir','/admin/ban/'.$assocActu->id, ['style'=>'color: black', 'class'=>'item']);
                                }


                                echo '<div class="item">Ajouter temps</div>
                                        <div class="item">Ajouter score</div>';
                                if(!($assocActu->nom == "Park'O'Drone")){
                                    if($assocActu->groupe == "admin"){
                                        echo $this->Html->link('Rétrograder','/admin/retrograde/'.$assocActu->id,['style'=>'color: black', 'class'=>'item']);
                                    }
                                    else{
                                        echo $this->Html->link('Promouvoir','/admin/promote/'.$assocActu->id, ['style'=>'color: black', 'class'=>'item'] );
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
                                echo $this->Html->link('<button class="ui gray circular button">Site web</button>', $assocActu->website, ['escape'=>false, 'target'=>'_blank']);
                            }


                            ?>
                        </div>
                    </div>
                </div>

                <div class="row" style="text-align: justify; margin: 5%; "><?= $assocActu->description ?></div>
            </div>
        </div>
        <br>
        <div class="two column row">
            <div class=" six wide column">
                <div class="inline" style="text-align:right">
                    <span>
                         <h3>Score total :</h3>
                    </span>
                    <span>
                        <?= $assocActu->score ?>
                    </span>
                </div>

                <div class="inline" style="text-align:right">
                    <h3>Classement global :</h3>
                    <span>
                        <?= $assocActu->score ?> ème
                    </span>
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

                    </div>
                    <table>

                    </table>
                    <table>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
