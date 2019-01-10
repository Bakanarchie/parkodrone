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
        if($this->request->getSession()->read('currUser') != null){
            $this->Associations->Competitions->link($this->Associations->get($this->request->getSession()->read('currUser')), [$this->Associations->Competitions->get($idComp)]);
            $this->redirect('/');
        }
        else{
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
                $this->redirect(['controller'=>'associations', 'action'=>'connectForm']);
        }


    }

    public function connectForm()
    {
        $assoc = $this->Associations->newEntity();
        $this->set(compact('assoc'));
    }

    public function connect()
    {
        $data = $this->getRequest()->getData();
        foreach($data as $key=>$dat){
            preg_replace('<script>', '', $data[$key]);
        }
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
            if(trim(strtolower($assocTemp->Groupe)) == 'admin'){
                $this->request->getSession()->write('isAdmin', true);
            }
            else{
                $this->request->getSession()->write('isAdmin', false);
            }
            if($this->request->getSession()->read('isAdmin')){
                $this->redirect('/admin/');
            }
            else{
                $this->redirect('/');
            }

        }
        else{
            $this->Flash->error('La combinaison nom/mot de passe n\'existe pas.');
            $this->redirect($this->referer());
        }
    }

    public function disconnect(){
        $this->request->getSession()->delete('currUser');
        $this->request->getSession()->write('isAdmin', false);
        $this->redirect('/');
    }

    public function registerForm(){
        $assoc = $this->Associations->newEntity();
        $this->set(compact('assoc'));
    }

    public function register(){
        $data = $this->getRequest()->getData();
        foreach($data as $key=>$dat){
            preg_replace('<script>', '', $data[$key]);
        }
        if($data['MDP'] != $data['confmdp']){
            $this->Flash->error('Erreur lors de la confirmation de votre mot de passe.');
            $this->redirect($this->referer());
        }
        else{
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
                    $this->request->getSession()->write('isAdmin', false);
                    $this->redirect('/');
                }
            }
            else{
                $this->Flash->error('Erreur : Cette entreprise existe déjà.');
                $this->redirect($this->referer());
            }
        }


    }

    public function search(){
        $data = $this->getRequest()->getData();
        $assoc = $this->Associations->find()->select()->where(['Nom LIKE'=>'%'.$data['content'].'%'])->toArray();
        $comp = $this->Associations->Competitions->find()->select()->where(['NomCompetition LIKE'=>'%'.$data['content'].'%'])->toArray();
        $this->set(
            compact('assoc')
        );
        $this->set(
            compact('comp')
        );
    }

    public function showProfile($id)
    {
        $assocActu = $this->Associations->get($id);
        if($assocActu == null){
            $this->redirect('/');
        }
        else{
            $this->set(compact('assocActu'));
        }
    }
}