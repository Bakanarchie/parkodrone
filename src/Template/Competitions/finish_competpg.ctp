<div class="ui container">
    <?= $this->Html->link('<button class="ui black button">'."Retour à la page d'accueil".'</button>', '/', ['escape'=>false]) ?>
    <div class="ui eight wide column"  style="overflow-y: scroll ; height: 640px " id="foo">

        <div>

            <table class="ui  selectable compact unstackable single line table" >
                <thead >
                <tr style="background-image:url(img/banner.png)">
                    <th colspan="4" ; style="background-image:url(img/banner.png)"><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">PARTICIPANTS</p></th>
                </tr>
                </thead >
                <?php
                foreach($competition as $compet){
                    foreach($compet->associations as $associations){
                        echo '<tr >';
                        echo '<td>';
                        echo '<h4 class="ui header" ><div class="content">'.$this->Html->image($associations->filename, ['class'=>'ui tiny image' ,'style'=>'width:40px; height:40px;']);


                        echo '</td >';

                        echo '<td>';

                        echo '<h4 class="ui header"><div class="content" ><font color="#daa520">'.$this->Html->link($associations->nom, '/profil/'.$associations->id),'</font>';

                        echo '</td>';

                        echo '<td style="width: 90%"></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </table>
            <?='<a href="../finishCompet/'.$id.'"><button class="ui black button icon">Finaliser</button></a>'?>
        </div>
    </div>
</div>
