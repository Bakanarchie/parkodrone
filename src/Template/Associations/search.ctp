
<div class="ui container">

<div class="ui tabular menu">
    <div class="item" data-tab="tab-name">Entreprises</div>
    <div class="item" data-tab="tab-name2">Compétitions</div>
</div>
<div class="ui tab" data-tab="tab-name">
    <table class="ui stripped table">
        <?php
        if(empty($assoc)){
            echo '<tr><td><p>Il n\'y a pas d\'entreprises correspondant à votre recherche. :-(</p></td></tr>';
        }
        else{
            foreach($assoc as $assTemp){
                echo '<tr>';
                    echo '<td>';
                        echo $this->Html->link($assTemp->nom, '/profil/'.$assTemp->id);
                    echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</div>
<div class="ui tab" data-tab="tab-name2">
    <table class="ui table">
        <?php

        if(empty($comp)){
            echo '<tr><td><p>Il n\'y a pas de compétitions correspondant à votre recherche. :-(</p></td></tr>';
        }
        else{
            foreach($comp as $compTemp){
                echo '<tr>';
                    echo '<td>';
                        echo $this->Html->link($compTemp->NomCompetition, '/competition/'.$compTemp->id);
                    echo '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>
</div>

<script>$('.menu .item')
        .tab()
    ;</script>
</div>