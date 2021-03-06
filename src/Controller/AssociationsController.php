<?php
/**
 * Created by PhpStorm.
 * User: Théo
 * Date: 15/12/2018
 * Time: 14:07
 */

namespace App\Controller;
use Cake\I18n\Time;
use Cake\I18n\FrozenTime;
class AssociationsController extends AppController
{


    public function index(){
        Time::setJsonEncodeFormat('dd-MM-YYYY HH:mm:ss');  // For any mutable DateTime
        FrozenTime::setJsonEncodeFormat('dd-MM-YYYY HH:mm:ss');  // For any immutable DateTime
        Time::setDefaultLocale('fr-FR'); // For any mutable DateTime
        FrozenTime::setDefaultLocale('fr-FR'); // For any immutable DateTime
        Time::setToStringFormat('dd-MM-YYYY HH:mm:ss');
        FrozenTime::setToStringFormat('dd-MM-YYYY HH:mm:ss');
        $associations = $this->Associations->find('all')->order(['classement'=>'ASC'])->toArray();
        $competitions = $this->Associations->Competitions->find('all')->contain('Associations')->toArray();
        $this->set(compact('associations'));
        $jsonDate = array();
        foreach($competitions as $compTemp){
            $jsonDate[] = $compTemp->DateCompet;
        }
        $jsonDate = json_encode($jsonDate);
        $jsonDate = json_decode($jsonDate);
        $cpt = 0;
        foreach($competitions as $compTemp){
            $currDate = explode(' ', $jsonDate[$cpt]);
            $currDate[1] = explode(':', $currDate[1]);
            $compTemp->DateCompet = $currDate[0]." à ".$currDate[1][0]."h".$currDate[1][1];
            $cpt++;
        }
        $this->set(compact('competitions'));
    }

    public function registerToComp($idComp){
        if($this->request->getSession()->read('currUser') != null){
            $actuAsso = $this->Associations->get($this->request->getSession()->read('currUser'));
            $assostat = $this->Associations->Statistics->find()->where(['association_id'=>$actuAsso->id])->first();
            if ($assostat == null){
                $newstat = $this->Associations->Statistics->newEntity();
                $newstat->association_id = $actuAsso->id;
                $newstat->ratio = 0.0;
                $newstat->nbPremier = 0;
                $newstat->nbPodium = 0;
                $newstat->nbVictoire = 0;
                $newstat->nbDefaite = 0;
                $newstat->nbCompet = 1;
                $newstat->nbDuel = 0;

                if(!$this->Associations->Statistics->save($newstat)){
                    $this->Flash->error('Erreur lors des calculs des statisiques!');
                    $this->redirect($this->referer());
                }
            }
            else{
                $newstat = $this->Associations->Statistics->get($assostat->id);
                $newstat->nbCompet += 1;

                if(!$this->Associations->Statistics->save($newstat)){
                    $this->Flash->error('Erreur lors de la mise à jour des statisiques!');
                    $this->redirect($this->referer());
                }
            }
            $this->Associations->Competitions->link($actuAsso, [$this->Associations->Competitions->get($idComp)]);
            $this->redirect('/');
        }
        else{
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
                $this->redirect(['controller'=>'associations', 'action'=>'connectForm']);
        }
    }

    public function  unregisterFromComp($idComp){
        if($this->request->getSession()->read('currUser') != null){
            $assoactu = $this->Associations->get($this->request->getSession()->read('currUser'));
            $assostat = $this->Associations->Statistics->find()->where(['association_id'=>$assoactu->id])->first();
            $assostat = $this->Associations->Statistics->get($assostat->id);

            if(!$this->Associations->Statistics->delete($assostat)){
                $this->Flash->error('Erreur lors de la mise à jour des statistiques');
                $this->redirect($this->referer());
            }

            $this->Associations->Competitions->unlink($assoactu, [$this->Associations->Competitions->get($idComp)]);
            $this->redirect('/');
        }
        else{
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
            $this->redirect(['controller'=>'associations', 'action'=>'connectForm']);
        }
    }

    public function connectForm()
    {
        $data = $this->request->getSession()->read("lastData");
        if(!empty($data)){
            $data['MDP'] = $data['tempPass'];
            $assoc = $this->Associations->newEntity($data);
            $this->request->getSession()->delete('lastData');
        }
        else{
            $assoc = $this->Associations->newEntity();
        }

        $this->set(compact('assoc'));
    }

    public function connect()
    {
        $data = $this->getRequest()->getData();
        $data['tempPass'] = $data['mdp'];
        foreach($data as $key=>$dat){
            preg_replace('<script>', '', $data[$key]);
        }
        $data['tempPass'] = $data['MDP'];
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
            $this->request->getSession()->delete('lastData');
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
            $this->request->getSession()->write('lastData', $data);
            $this->redirect($this->referer());
        }
    }

    public function disconnect(){
        $this->request->getSession()->delete('currUser');
        $this->request->getSession()->write('isAdmin', false);
        $this->redirect('/');
    }

    public function registerForm(){
        $data = $this->request->getSession()->read("lastData");
        if(!empty($data)){
            $data['mdp'] = $data['tempPass'];
            $assoc = $this->Associations->newEntity($data);
            $this->request->getSession()->delete('lastData');
        }
        else{
            $assoc = $this->Associations->newEntity();
        }

        $this->set(compact('assoc'));
    }

    public function register(){
        $data = $this->getRequest()->getData();
        $data['tempPass'] = $data['mdp'];
        foreach($data as $key=>$dat){
            if($key != 'file')
                $data[$key] = htmlspecialchars($data[$key]);
        }
        if((trim($data['mdp']) != trim($data['confmdp'])) || empty($data['mdp'])){
            $data['tempPass'] = "";
            $this->Flash->error('Votre mot de passe est invalide.');
            $this->request->getSession()->write('lastData', $data);
            $this->redirect($this->referer());
        }
        else{
            if(strlen($data['nom']) < 4){
                $this->Flash->error('Erreur : Veuillez entrer plus de quatre caractères dans le champ nom.');
                $this->request->getSession()->write('lastData', $data);
                $this->redirect($this->referer());
            }
            else{
                if($data['file']['type'] != 'image/jpeg' && $data['file']['type'] != 'image/png'){
                    $this->Flash->error('Veuillez choisir un image de type .jpg ou .jpeg ou .png');
                    $this->request->getSession()->write('lastData', $data);
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
                            $this->Flash->error('Il y a eu une erreur lors de la sauvegarde de votre compte.');
                            $this->request->getSession()->write('lastData', $data);
                            $this->redirect($this->referer());
                        }
                        else{
                            $assoc_new = $this->Associations->find()->select()->where(['nom'=>$data['nom']])->first();
                            $this->request->getSession()->write('currUser', $assoc_new->id);
                            $this->request->getSession()->write('isAdmin', false);
                            $this->request->getSession()->delete('lastData');
                            $this->redirect('/');
                        }
                    }
                    else{
                        $this->Flash->error('Erreur : Cette entreprise existe déjà.');
                        $this->request->getSession()->write('lastData', $data);
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
        $compResults = $this->Associations->Results->find()->where(['association_id'=>$id, 'isDuel'=>false])->toArray();
        $duelResults = $this->Associations->Results->find()->where(['association_id'=>$id, 'isDuel'=>true])->toArray();
        if($compResults != null)
        $this->set->compact('compResults');
        if($duelResults != null)
        $this->set->compact('duelResults');
        if($assocActu == null){
            $this->redirect('/');
        }
        else{
            if(!(substr( $assocActu->website, 0, 7 ) === "http://") && !(substr( $assocActu->website, 0, 8 ) === "https://")){
                $assocActu->website = "http://".$assocActu->website;
                $this->Associations->save($assocActu);
            }
            if((substr( $assocActu->website, 0, 15 ) === "http://https://")){
                $tempSite = substr( $assocActu->website, 16);
                $assocActu->website = "http://".$assocActu->website;
                $this->Associations->save($assocActu);
            }
            else{
                if((substr( $assocActu->website, 0, 15 ) === "https://http://")){
                    $tempSite = substr( $assocActu->website, 16);
                    $assocActu->website = "https://".$assocActu->website;
                    $this->Associations->save($assocActu);
                }
            }
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
                $assocToChange = $this->Associations->find()->select()->where(['classement >' => $association->classement])->toArray();
                foreach($assocToChange as $assocTemp){
                    $assocTemp->classement--;
                }
                foreach($assocToChange as $assocTemp){
                    $this->Associations->save($assocTemp);
                }
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
        }
        else {
            $data = $this->getRequest()->getData();
            $toEdit = $this->Associations->get($data['id']);
			$prevClass = $toEdit->classement;
            $toEdit->score = $data['Associations']['score'];
            $assocAll = $this->Associations->find('all')->select()->order(['score'=>'ASC'])->toArray();
            $newClassement = 1;
			$modify = false;
			foreach ($assocAll as $assocTemp){
					if($assocTemp->score > $toEdit->score){
						$newClassement++;
					}
				}
			foreach ($assocAll as $assocTemp){
                if($assocTemp->classement == $newClassement && $assocTemp->id != $toEdit->id){
                    $modify = true;
                }
            }
			if($modify){
				
				
				foreach ($assocAll as $assocTemp){
					if($assocTemp->classement >= $newClassement && $assocTemp->id != $toEdit->id && $assocTemp->classement < $prevClass){
						$assocTemp->classement++;
					}
				}
				foreach($assocAll as $key=>$assocTemp){
					$this->Associations->save($assocTemp);
				}
			}
            $toEdit->classement = $newClassement;
            $this->Associations->save($toEdit);
        }
		$this->redirect('/');
    }

    public function stats($id){
        $assocActu = $this->Associations->find()->select()->where(["id"=>$id])->contain(['Competitions', "Duels"])->first();
        $ccompAssoc = $assocActu->competitions;
        //$allyAssoc = $assocActu->alliances;
        $duelsAssoc = $assocActu->duels;
        $duelprovoc = array();
        foreach ($duelsAssoc as $duelTemp){
            if($duelTemp->initiatorId == $id){
                $duelprovoc[] = $duelTemp;
            }
        }
        $this->set(compact('duelprovoc'));
        $this->set(compact('ccompAssoc'));
        $this->set(compact('duelsAssoc'));
        $ref = $this->referer();
        $this->set(compact('ref'));
        //$this->set(compact('allyAssoc'));
        $compResults = $this->Associations->Results->find()->where(['association_id'=>$id, 'isDuel'=>false])->toArray();
        $duelResults = $this->Associations->Results->find()->where(['association_id'=>$id, 'isDuel'=>true])->toArray();
        if($compResults != null)
            $this->set(compact('compResults'));
        if($duelResults != null)
            $this->set->compact(('duelResults'));

        if($assocActu == null){
            $this->redirect('/');
        }
        else{
            $this->set(compact('assocActu'));
        }
    }

    public function addResultForm($id){

    }

    public function checkdb(){
        $sess = $this->getRequest()->getSession();
        if($sess->read('currUser') != null){
            $assocActu = $this->Associations->get($sess->read('currUser'));
            $sess->write('isAdmin', false);
            if($assocActu->isAdmin) $sess->write('isAdmin', true);
        }
        return null;
    }
}