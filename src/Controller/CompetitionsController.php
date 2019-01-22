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
        foreach($data as $key=>$dat){
            if($key != 'file')
            $data[$key] = htmlspecialchars($data[$key]);
        }
        dd($data);
        if($data['file']['type'] != 'image/jpeg' || $data['file']['type'] != 'image/png'){
            $this->Flash->error('Veuillez choisir une image de type .jpeg ou .png!');
            $this->redirect($this->referer());
        }
        move_uploaded_file($data['file']['tmp_name'],
            WWW_ROOT.'img/'.strtolower($data['file']['name']));
        $comp = $this->Competitions
            ->find()
            ->where(['NomCompetition' => $data['NomCompet']])
            ->first();
        $data['terminee'] = 0;
        $data['Image'] = strtolower($data['file']['name']);
        $tosave = $this->Competitions->newEntity($data);
        if($comp == null){
            if(!$this->Competition->save($tosave)){
                $this->Flash->error('Il y a eu une erreur lors de la sauvegarde des données.');
                $this->redirect($this->referer());
            }
        }

    }

    public function affichedetail($id){
        $compet = $this->Competitions->get($id);
        $this->set(compact('compet'));
    }
}
