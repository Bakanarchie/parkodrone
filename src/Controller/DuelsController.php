<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 21/01/2019
 * Time: 10:04
 */

namespace App\Controller;


class DuelsController extends AppController
{

    public function defyForm($id){
        $newDefi = $this->Duels->newEntity();
        $this->set(compact('newDefi'));
        $this->set(compact('id'));
    }

    public function defy($id){
        if($this->request->getSession()->read('currUser') == null){
            $this->redirect($this->referer());
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
        }
        else{
            $this->Duels->newEntity();

        }
    }

}