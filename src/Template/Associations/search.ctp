<div style="background-image: url(../img/bg.png); margin-right: 5%; margin-left: 5%">
    <div class="ui fluid container" style="background-image: url(../img/whitebg.png)" >
<br>

<div class="ui container">

<div class="ui two item pointing attached menu">
    <div id="item1" class="item toAdd" data-tab="tab-name" style="font-family: Oswald  ; font-weight: 900; font-size: larger">Entreprises</div>
    <div class="item" data-tab="tab-name2" style="font-family: Oswald ; font-weight: 900; font-size: larger">Compétitions</div>
</div>
<div class="ui tab toAdd" data-tab="tab-name">
    <table class="ui selectable stripped table">
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
    <table class="ui selectable stripped table">
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

    <script>
        $('.toAdd').addClass('active');
        $('toAdd').removeClass('toAdd');
    </script>
</div>
<br>