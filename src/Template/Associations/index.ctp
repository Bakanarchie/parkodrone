
        <table class="ui selectable compact  single line table">
            <thead>
            <tr style="background-color: #e4e4e5">
                <th colspan="4" ; style="background-color: #747475 "><p style="font-size:large ; color:white">Classement Général</p></th>
            </tr>
            </thead>
            <?php
                foreach($associations as $assocTemp){
                    echo '<tr>';
                        echo '<td>';

                            echo '<h4 class="ui header"><div class="content">'.$this->Html->link($assocTemp->nom, '/profil/'.$assocTemp->id);
                            if($assocTemp->classement == 1){
                                echo '<div class="sub header">'.$assocTemp->classement.'er';
                            }
                            else{
                                echo '<div class="sub header">'.$assocTemp->classement.'ème';
                            }
                            echo '</div></div></h4>';
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
	</div>
	<div class="ui eight wide column">
        <table class="ui selectable celled stripped table">
            <thead>
            <tr style="background-color: #626263">
                <th style="background-color: #747475 "><p style="font-size:large ; color:white">Compétitions à venir</p></th>
            </tr>
            </thead>
            <?php

            foreach($competitions as $compTemp){
                if(!$compTemp->terminee){
                    echo '<tr>';
                        echo '<td>';
                            echo '<h4 class="ui header"><div class="content">'.$this->Html->link($compTemp->NomCompetition, '/competition/'.$compTemp->id);
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
            <tr style="background-color: #e4e4e5">
                <th style="background-color: #747475 "><p style="font-size:large ; color:white">Dernières compétitions</p></th>
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