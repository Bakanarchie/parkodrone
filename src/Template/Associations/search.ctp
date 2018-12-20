<div class="ui inverted tabular menu">
    <div class="item" data-tab="tab-name">Entreprises</div>
    <div class="item" data-tab="tab-name2">Compétitions</div>
</div>
<div class="ui tab" data-tab="tab-name">
    <table class="ui stripped inverted table">
        <?php
        if(empty($assoc)){
            echo '<tr><td><p>Il n\'y a pas d\'entreprises correspondant à votre recherche. :-(</p></td></tr>';
        }
        else{
            foreach($assoc as $assTemp){

            }
        }
        ?>
    </table>
</div>
<div class="ui tab" data-tab="tab-name2">
    <table class="ui inverted table">
        <?php

        if(empty($comp)){
            echo '<tr><td><p>Il n\'y a pas de compétitions correspondant à votre recherche. :-(</p></td></tr>';
        }
        else{
            foreach($comp as $compTemp){

            }
        }
        ?>
    </table>
</div>

<script>$('.menu .item')
        .tab()
    ;</script>