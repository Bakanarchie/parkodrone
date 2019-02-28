<div class="ui container">
    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr style="background-image:url(img/banner.png)">
            <th colspan="4" ; style="background-image:url(img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">DEFIS</p></th>
        </tr>
        </thead>
        <?php
            foreach($duelsContain as $duelTemp){
                if(!$duelTemp->isAccepted){
                    echo '<tr><td>';
                    foreach($duelTemp->associations as $assocAssociated){
                        if($assocAssociated->id != $currAssoc->id) $assocTemp = $assocAssociated;
                    }
                    echo '<h4 class="ui header"><div class="content" >'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                    if($duelTemp->initiatorId != $currAssoc->id){

                    }
                    echo '</div></h4></td></tr>';
                }
            }

        ?>
    </table>
    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr style="background-image:url(img/banner.png)">
            <th colspan="4" ; style="background-image:url(img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">À VENIR</p></th>
        </tr>
        </thead >
    </table>


    <table class="ui  selectable compact unstackable single line table" >
        <thead >
        <tr style="background-image:url(img/banner.png)">
            <th colspan="4" ; style="background-image:url(img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">TERMINÉES</p></th>
        </tr>
        </thead >

    </table>
</div>