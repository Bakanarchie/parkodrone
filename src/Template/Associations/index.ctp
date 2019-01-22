<div  style="width: 100% ; height: auto; background-image: url(img/blocbg.png) ; margin-bottom: 3%">
    <div class="ui stackable grid">

        <div class="ten wide column" style="color: white ; margin-left: 5% ; text-align: justify">
            <p>Park’o drone est une entreprise proposant des services événementiels sur mesure pour les entreprises, institutions et associations.
            L’objectif est de prendre du plaisir dès les 30 premières secondes avec le pilotage de drones (roulants et volants) en immersion.
            Aujourd’hui c’est plus de 10 000 pilotes qui ont déjà testé le concept.</p>
            <p style="text-align: center">
            <div class="ui inverted horizontal divider"> </div>
                <button class=" basic inverted yellow ui button" style="width: 100% ;font-family:Oswald,SansSerif ;vertical-align: bottom" onclick="location.href='http://www.parkodrone.fr/'">EN SAVOIR PLUS...</button>
            </p>

        </div>

        <div  class="  one wide column" style="text-align: center" > <iframe width="auto" height="auto" src="https://www.youtube.com/embed/RwLnN4eSnik" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe></div>

    </div>
</div>

<script type="text/javascript">
    <!--
    function toggle_visibility(id) {
        var e = document.getElementById(id);
        if(e.style.display == 'block')
            e.style.display = 'none';
        else
            e.style.display = 'block';
    }
    //-->
</script>





<button class="ui    mobile only    center aligned    large menu grid   fluid " href="#"  style="height = 40 px" onclick="toggle_visibility('foo');">
    Masquer/Afficher
</button>





<div class="ui stackable two column grid">

    <div class="ui eight wide column"  style="overflow-y: scroll ; height: 640px " id="foo">

        <div>

        <table class="ui  selectable compact  single line table" >
            <thead >
            <tr style="background-color: #454546">
                <th colspan="4" ; style="background-color: #454546 "><p style="font-size:large; font-family: Oswald, sans-serif ; color:#fefeff">CLASSEMENT GÉNÉRAL</p></th>
            </tr>
            </thead >
                 <?php
                foreach($associations as $assocTemp){
                    echo '<tr >';
                    echo '<td>';
                        echo '<h4 class="ui header" ><div class="content">'.$this->Html->image($assocTemp->filename, ['class'=>'ui tiny image' ,'style'=>'width:40px; height:40px;']);


                    echo '</td >';

                        echo '<td>';

                            if($assocTemp->classement == 1){
                                echo '<h4 class="ui header"><div class="content" ><font color="#daa520">'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id),'</font>';
                                echo '<div class="sub header" style="font-family: Oswald,SansSerif"><font color="#daa520"><b>'.$assocTemp->classement.'er</b></font>';
                            }
                            else if($assocTemp->classement == 2){
                                echo '<h4 class="ui header"><div class="content" ><font color="silver">'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id),'</font>';
                                echo '<div class="sub header" style="font-family: Oswald,SansSerif"><font color="silver"><b>'.$assocTemp->classement.'ème</b></font>';
                            }
                            else if($assocTemp->classement == 3){
                                echo '<h4 class="ui header"><div class="content" ><font color="##bc8f8f">'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id),'</font>';
                                echo '<div class="sub header" style="font-family: Oswald,SansSerif"><font color="#bc8f8f"><b>'.$assocTemp->classement.'ème</b></font>';
                            }
                            else{
                                echo '<h4 class="ui header"><div class="content" >'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                                echo '<div class="sub header" style="font-family: Oswald,SansSerif">'.$assocTemp->classement.'ème';
                            }

                        echo '</td>';


                    echo '<td>';

                    echo '<h4><div class="content">'.' ';


                    echo'</td>';

                    echo '<td>';

                    if($assocTemp->classement == 1){
                        echo '<h4><div class="content" style="text-align:right;font-family: Oswald,SansSerif;margin-right: 10%"><font color="#daa520" size=5>'.$assocTemp->score.' pts</font>';
                    }
                    else if($assocTemp->classement == 2){
                        echo '<h4><div class="content" style="text-align:right;font-family: Oswald,SansSerif;margin-right: 10%"><font color="silver"  size=5>'.$assocTemp->score.' pts</font>';
                    }
                    else if($assocTemp->classement == 3){
                        echo '<h4><div class="content" style="text-align:right;font-family: Oswald,SansSerif;margin-right: 10%"><font color="#bc8f8f" size=5>'.$assocTemp->score.' pts</font>';
                    }
                    else{
                        echo '<h4><div class="content" style="text-align:right;font-family: Oswald,SansSerif;margin-right: 10%"><font                 size=5>'.$assocTemp->score.' pts</font>';
                    }


                    echo'</td>';
                    echo '</div>';

                    echo '</tr>';
                }
            ?>
        </table>
        </div>
	</div>
	<div class="ui center aligned eight wide column">
        <table class="ui selectable celled stripped table">
            <thead>
            <tr style="background-color: #454546">
                <th style="background-color: #454546 "><p style="font-size:large ;font-family: Oswald, sans-serif ; color:white">COMPÉTITIONS À VENIR</p></th>
            </tr>
            </thead>
            <?php

            foreach($competitions as $compTemp){
                if(!$compTemp->terminee){
                    echo '<tr>';
                        echo '<td>';
                            echo '<h4 class="ui header"><div class="content">'.$this->Html->link($compTemp->NomCompetition, '/compet/'.$compTemp->id);
                            echo '<div class="sub header"> Aura lieu le '.$compTemp->DateCompet;
                            echo '</div></div></h4>';
                            if(!($this->request->getSession()->read('currUser') == null)){
                                $buttonRegister = true;
                                foreach($compTemp->associations as $assocTemp){
                                    if($assocTemp->id == $this->request->getSession()->read('currUser')){
                                        $buttonRegister = false;
                                    }
                                }
                                if($buttonRegister){
                                    echo '<a href="./associations/registerToComp/'.$compTemp->id.'"><button class="ui black button">Inscrire mon équipe</button></a>';
                                }
                                else{
                                    echo '<a href="./associations/unregisterFromComp/'.$compTemp->id.'"><button class="ui black button icon"><i class="check icon"></i></button></a>';
                                }
                            }
                        echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>

        <table class="ui selectable celled stripped table">
            <thead>
            <tr style="background-color: #454546">
                <th style="background-color: #454546 "><p style="font-size:large ; font-family: Oswald, sans-serif; color:white">DERNIÈRES COMPÉTITIONS</p></th>
            </tr>
            </thead>
            <?php

            foreach($competitions as $compTemp){
                if($compTemp->terminee){
                    echo '<tr>';
                    echo '<td>';
                    echo '<h4 class="ui header"><div class="content">'.$this->Html->link($compTemp->NomCompetition, '/compet/'.$compTemp->id);
                    echo '<div class="sub header"> A eu lieu le '.$compTemp->DateCompet;
                    echo '</div></div></h4>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
	</div>
</div>


</div>