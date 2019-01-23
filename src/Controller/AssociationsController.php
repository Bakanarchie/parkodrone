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
        $associations = $this->Associations->find('all')->order(['classement'=>'ASC'])->toArray();
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

    public function  unregisterFromComp($idComp){
        if($this->request->getSession()->read('currUser') != null){
            $this->Associations->Competitions->unlink($this->Associations->get($this->request->getSession()->read('currUser')), [$this->Associations->Competitions->get($idComp)]);
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
            if(trim(strtolower($assocTemp->groupe)) == 'admin'){
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
            if($key != 'file')
                $data[$key] = htmlspecialchars($data[$key]);
        }
        if((trim($data['mdp']) != trim($data['confmdp'])) || empty($data['mdp'])){
            $this->Flash->error('Erreur lors de la confirmation de votre mot de passe.');
            $this->redirect($this->referer());
        }
        else{
            if(strlen($data['nom']) < 4){
                $this->Flash->error('Erreur : Veuillez entrer plus de quatre caractères dans le champ nom.');
                $this->redirect($this->referer());
            }
            else{
                if($data['file']['type'] != 'image/jpeg' && $data['file']['type'] != 'image/png'){
                    $this->Flash->error('Veuillez choisir un image de type .jpg ou .jpeg ou .png');
                    $this->redirect($this->referer());
                }
                else{
                    //dd($data);
                    move_uploaded_file($data['file']['tmp_name'],
                        WWW_ROOT.'img/'.strtolower($data['file']['name']));
                    $data['mdp'] = hash("sha256", $data['mdp']);
                    $data['filename'] = strtolower($data['file']['name']);
                    $toSave = $this->Associations->newEntity($data);
                    $assoc_new = $this->Associations->find()->select()->where(['LOWER(nom)'=>strtolower($data['nom'])])->first();
                    if($assoc_new == null){
                        if(!$this->Associations->save($toSave)){
                            dd($toSave);
                            $this->Flash->error('Il y a eu une erreur lors de la sauvegarde de votre mot de passe.');
                            $this->redirect($this->referer());
                        }
                        else{
                            $assoc_new = $this->Associations->find()->select()->where(['nom'=>$data['nom']])->first();
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
        }
    }

    public function search(){
        $data = $this->getRequest()->getData();
        $assoc = $this->Associations->find()->select()->where(['LOWER(Nom) LIKE'=>'%'.strtolower($data['content']).'%'])->toArray();
        $comp = $this->Associations->Competitions->find()->select()->where(['LOWER(NomCompetition) LIKE'=>'%'.strtolower($data['content']).'%'])->toArray();
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
        $compResults = $this->Associations->Results->find()->where(['idAssoc'=>$id, 'isDuel'=>false])->toArray();
        $duelResults = $this->Associations->Results->find()->where(['idAssoc'=>$id, 'isDuel'=>true])->toArray();
        if($compResults != null)
        $this->set->compact('compResults');
        if($duelResults != null)
        $this->set->compact('duelResults');
        if($assocActu == null){
            $this->redirect('/');
        }
        else{
            $this->set(compact('assocActu'));
        }
    }

    public function admin(){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else{
            $associations = $this->Associations->find('all')->toArray();
            $competitions = $this->Associations->Competitions->find('all')->toArray();
            $this->set(
                compact('associations')
            );
            $this->set(
                compact('competitions')
            );
        }
    }

    public function promote($id){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else{
            $association = $this->Associations->get($id);
            if($association->nom == "Park'O'Drone"){
                $this->Flash->error('Erreur : Cette entreprise est intouchable.');
                $this->redirect($this->referer());
            }
            else{
                if($association->groupe == "admin"){
                    $this->Flash->error('Erreur : Ce membre est déjà un administrateur.');
                    $this->redirect($this->referer());
                }
                else{
                    $association->groupe = "admin";
                    if(!($this->Associations->save($association))){
                        $this->Flash->error('Il y a eu une erreur lors de la sauvegarde.');
                    }
                    $this->redirect($this->referer());
                }
            }

        }

    }

    public function retrograde($id){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else{
            $association = $this->Associations->get($id);
            if($association->nom == "Park'O'Drone"){
                $this->Flash->error('Erreur : Cette entreprise est intouchable.');
                $this->redirect($this->referer());
            }
            else{
                if($association->groupe == "user"){
                    $this->Flash->error('Erreur : Ce membre est déjà un utilisateur.');
                    $this->redirect($this->referer());
                }
                else{
                    $association->groupe = "user";

                    if(!($this->Associations->save($association))){
                        $this->Flash->error('Il y a eu une erreur lors de la sauvegarde.');
                    }
                    $this->redirect($this->referer());
                }
            }

        }
    }

    public function ban($id){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else{
            $association = $this->Associations->get($id);
            if($association->nom == "Park'O'Drone"){
                $this->Flash->error('Erreur : Cette entreprise est intouchable.');
                $this->redirect($this->referer());
            }
            else{
                $this->Associations->delete($association);
				
                $this->redirect('/');
            }

        }
    }

    public function addScoreForm($id){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else {
            $toEdit = $this->Associations->get($id);
            $this->set(compact('toEdit'));
        }

    }

    public function addScore(){
        if(!$this->request->getSession()->read('isAdmin')){
            $this->Flash->error('Vous devez être un administrateur pour accéder à cette page.');
            $this->redirect('/');
        }
        else {
            $data = $this->getRequest()->getData();
            $toEdit = $this->Associations->get($data['id']);
            $toEdit->score = $data['Associations']['score'];
            $assocAll = $this->Associations->find('all')->select()->order(['score'=>'ASC'])->toArray();
            $newClassement = 1;
            foreach ($assocAll as $assocTemp){
                if($assocTemp->score > $toEdit->score){
                    $newClassement++;
                }
            }
			$toEdit->classement = $newClassement;
            foreach ($assocAll as $assocTemp){
                if($assocTemp->classement >= $newClassement && $assocTemp->id != $toEdit->id){
                    $assocTemp->classement++;
                }
            }
            foreach($assocAll as $key=>$assocTemp){
                $this->Associations->save($assocTemp);
            }
            $this->Associations->save($toEdit);
        }

    }
}