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

    public function saveNewComp(){
        $data = $this->getRequest()->getData();
        if(is_empty($data)){
            $this->Flash->error("Informations manquantes, vérifiez que vous n'avez rien oublié");
            $this->redirect($this->referer());
        }
        else{
            $comp = $this->Competitions
                ->find()
                ->where(['NomCompetition' => $data['NomCompet']])
                ->first();
            $data['terminee'] = 0;
            $tosave = $this->Competitions->newEntity($data);
            if($comp == null){
                if(!$this->Competition->save($tosave)){
                    $this->Flash->error('Il y a eu une erreur lors de la sauvegarde des données.');
                    $this->redirect($this->referer());
                }
            }
        }
    }

    public function affichedetail($id){
        $compet = $this->Competitions->get($id);
        $image = $this->Competitions->Associations
            ->find()
            ->where(['nom =' => "Park'O'Drone"])
            ->first();

        $this->set(compact('compet'));
        $this->set(compact('image'));
    }
}
