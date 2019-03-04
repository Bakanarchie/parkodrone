<div class="ui container">
    <br>
    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr style="background-image:url(img/banner.png)">
            <th colspan="4" ; style="background-image:url(../webroot/img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">INVITATIONS </p></th>
        </tr>
        </thead>
        <?php
        if(empty($duelsToAccept)){
            echo '<tr><td><h4 class="ui header"><div class="content" >Il n\'y a rien à afficher pour le moment :-(</div></h4></td></tr>';
        }
        else{
            foreach($duelsToAccept as $duelTemp){
                if(!$duelTemp->isAccepted){
                    echo '<tr><td>';
                    foreach($duelTemp->associations as $assocAssociated){
                        if($assocAssociated->id != $currAssoc->id) $assocTemp = $assocAssociated;
                    }
                    echo '<h4 class="ui header"><div class="content" >'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                    if($duelTemp->initiatorId != $currAssoc->id){
                        echo $this->Html->link('<button class="ui green button" ; style="font-family: Oswald;">ACCEPTER</button>', ['controller'=>'duels', 'action'=>'accept', $duelTemp->id], ['escape'=>false]);
                        echo $this->Html->link('<button class="ui red button" style="margin-left: 10px; font-family: Oswald;">REFUSER</button>', ['controller'=>'duels', 'action'=>'decline', $duelTemp->id], ['escape'=>false]);
                    }
                    echo '</div></h4></td></tr>';
                }
            }
        }
        ?>
    </table>
    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr>
            <th colspan="4" ; style="background-image:url(../webroot/img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DÉFIS PLANNIFIÉS</p></th>
        </tr>
        </thead >
        <?php
        if(empty($duelsNotOver)){
            echo '<tr><td><h4 class="ui header"><div class="content" >Il n\'y a rien à afficher pour le moment :-(</div></h4></td></tr>';
        }
        else{
            foreach($duelsNotOver as $duelTemp){
                if($duelTemp->isAccepted){
                    if(!$duelTemp->isOver){
                        echo '<tr><td>';
                        foreach($duelTemp->associations as $assocAssociated){
                            if($assocAssociated->id != $currAssoc->id) $assocTemp = $assocAssociated;
                        }
                        echo '<h4 class="ui header"><div class="content" >'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                        echo '</div></h4></td></tr>';
                    }
                }
            }
        }

        ?>
    </table>


    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr style="background-image:url(img/banner.png)">
            <th colspan="4" ; style="background-image:url(../webroot/img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DÉFIS TERMINÉS</p></th>
        </tr>
        </thead>
        <?php
        if(empty($duelsOver)){
            echo '<tr><td><h4 class="ui header"><div class="content" >Il n\'y a rien à afficher pour le moment :-(</div></h4></td></tr>';
        }
        else{
            foreach($duelsOver as $duelTemp){
                if($duelTemp->isAccepted){
                    if($duelTemp->isOver){
                        echo '<tr><td>';
                        foreach($duelTemp->associations as $assocAssociated){
                            if($assocAssociated->id != $currAssoc->id) $assocTemp = $assocAssociated;
                        }
                        echo '<h4 class="ui header"><div class="content" >'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                        echo '</div></h4></td></tr>';
                    }
                }
            }
        }

        ?>
    </table>
    <br>
</div>