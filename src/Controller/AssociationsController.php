<?php
/**
 * Created by PhpStorm.
 * User: Théo
 * Date: 15/12/2018
 * Time: 14:07
 */

namespace App\Controller;
class AssociationsController extends AppController
{


    public function index(){
        $associations = $this->Associations->find('all')->toArray();
        $competitions = $this->Associations->Competitions->find('all')->contain('Associations')->toArray();
        $this->set(compact('associations'));
        $this->set(compact('competitions'));
    }

    public function registerToComp($idComp){

    }

    public function connectForm()
    {
        $assoc = $this->Associations->newEntity();
        $this->set(compact('assoc'));
    }

    public function connect()
    {
        $data = $this->getRequest()->getData();
        $data['MDP'] = hash("sha256", $data['MDP']);
        $assocTemp = $this->Associations->find()
            ->select()
            ->where(
                [
                    'MDP'=>$data['MDP'],
                    'Nom'=>$data['Nom']
                ]
            )
            ->first();
        if($assocTemp != null){
            $this->request->getSession()->write('currUser', $assocTemp->id);
            $this->redirect('/');
        }
        else{
            $this->Flash->error('La combinaison nom/mot de passe n\'existe pas.');
            $this->redirect($this->referer());
        }
    }

    public function disconnect(){
        $this->request->getSession()->delete('currUser');
        $this->redirect('/');
    }

    public function registerForm(){
        $assoc = $this->Associations->newEntity();
        $this->set(compact('assoc'));
    }

    public function register(){
        $data = $this->getRequest()->getData();
        $data['MDP'] = hash("sha256", $data['MDP']);
        $toSave = $this->Associations->newEntity($data);
        $assoc_new = $this->Associations->find()->select()->where(['Nom'=>$data['Nom']])->first();
        if($assoc_new == null){
            if(!$this->Associations->save($toSave)){
                $this->Flash->error('Il y a eu une erreur lors de la sauvegarde de votre mot de passe.');
                $this->redirect($this->referer());
            }
            else{
                $assoc_new = $this->Associations->find()->select()->where(['Nom'=>$data['Nom']])->first();
                $this->request->getSession()->write('currUser', $assoc_new->id);
                $this->redirect('/');
            }
        }
        else{
            $this->Flash->error('Erreur : Cette entreprise existe déjà.');
            $this->redirect($this->referer());
        }

    }
}