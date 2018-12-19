<div class="ui two column grid">
	<div class="ui computer only column">
        <table class="ui inverted stripped celled table">
            <thead>
            <tr>
                <th>Associations / Classement</th>
            </tr>
            </thead>
            <?php
                foreach($associations as $assocTemp){
                    echo '<tr>';
                        echo '<td>';
                            echo '<h4 class="ui image header">';
                            echo $this->Html->image($assocTemp->filename, ['class'=>'ui image']);
                            echo '<div class="content">'.$assocTemp->Nom;
                            if($assocTemp->Classement == 1){
                                echo '<div class="sub header">'.$assocTemp->Classement.'er';
                            }
                            else{
                                echo '<div class="sub header">'.$assocTemp->Classement.'ème';
                            }
                            echo '</div></div>';
                            echo '</h4>';
                        echo '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
	</div>
	<div class="column">
        <table class="ui inverted stripped celled table">
            <thead>
            <tr>
                <th>Compétitions à venir</th>
            </tr>
            </thead>
            <?php

            foreach($competitions as $compTemp){
                if(!$compTemp->terminee){
                    echo '<tr>';
                        echo '<td>';
                            echo '<h4 class="ui image header"><div class="content">'.$compTemp->NomCompetition;
                            echo '<div class="sub header"> Aura lieu le '.$compTemp->DateCompet;
                            echo '</div></div>';
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
                                    echo '<a href="./associations/registerToComp/'.$compTemp->id.'"><button class="ui black button icon"><i class="check icon"></i></button></a>';
                                }
                            }
                        echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>

        <table class="ui inverted stripped celled table">
            <thead>
            <tr>
                <th>Compétitions terminées</th>
            </tr>
            </thead>
            <?php

            foreach($competitions as $compTemp){
                if($compTemp->terminee){
                    echo '<tr>';
                    echo '<td>';
                    echo '<h4 class="ui image header"><div class="content">'.$compTemp->NomCompetition;
                    echo '<div class="sub header"> A eu lieu le '.$compTemp->DateCompet;
                    echo '</div></div>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
        </table>
	</div>
</div>