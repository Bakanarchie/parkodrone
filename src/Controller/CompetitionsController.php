<?php
/**
 * Created by PhpStorm.
 * User: Théo
 * Date: 15/12/2018
 * Time: 14:08
 */

namespace App\Controller;


class CompetitionsController extends AppController
{

    public function declareAsOver($id){
        $currComp = $this->Competitions->get($id);
    }

    public function createComp(){
        if(!($this->request->getSession()->read('isAdmin'))){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        $newCompetition = $this->Competitions->newEntity();
        $this->set(compact('newCompetition'));
    }

}
