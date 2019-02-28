<div style="background-image: url(../img/whitebg.png)">
    <?= $this->Html->link('<button class="ui black button">'."Retour à la page d'accueil".'</button>', '/', ['escape'=>false]) ?>
    <div class="ui tabular menu">
        <div id="item1" class="item toAdd" data-tab="tab-name">Entreprises</div>
        <div class="item" data-tab="tab-name2">Compétitions</div>
    </div>
    <div class="ui tab toAdd" data-tab="tab-name">
        <table class="ui stripped table">
            <?php
            if(count($associations) == 1){
                echo '<tr><td><p>Il n\'y a pas d\'entreprises inscrites pour le moment.</p></td></tr>';
            }
            else{
                foreach($associations as $assTemp){
                    if($assTemp->id != $this->request->getSession()->read('currUser')){
                        echo '<tr>';
                        echo '<td>';
                        echo $this->Html->link($assTemp->nom, '/profil/'.$assTemp->id);
                        echo '</td>';
                        echo '</tr>';
                    }

                }
            }
            ?>
        </table>
    </div>
    <div class="ui tab" data-tab="tab-name2">
        <table class="ui table">
            <?php

            if(empty($competitions)){
                echo '<tr><td><p>Il n\'y a pas de compétitions pour le moment.</p></td></tr>';
            }
            else{
                foreach($competitions as $compTemp){
                    echo '<tr>';
                    echo '<td>';
                    echo $this->Html->link($compTemp->NomCompetition, '/compet/'.$compTemp->id);
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
            <tr><td><?= $this->Html->link('<button class="ui black button">Créer une compétition</button>', '/admin/createComp/', ['escape'=>false]) ?></td></tr>
        </table>
    </div>

    <script>$('.menu .item')
            .tab()
        ;</script>

    <script>
        $('.toAdd').addClass('active');
        $('toAdd').removeClass('toAdd');
    </script>
</div>