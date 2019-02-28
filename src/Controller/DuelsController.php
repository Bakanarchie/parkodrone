<?php
/**
 * Created by PhpStorm.
 * User: p1703235
 * Date: 21/01/2019
 * Time: 10:04
 */

namespace App\Controller;
use Cake\I18n\FrozenTime;

class DuelsController extends AppController
{

    public function defyForm($id){
        if($this->request->getSession()->read('currUser') == null){
            $this->redirect($this->referer());
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
        }
        else{
            if($id == $this->request->getSession()->read('currUser')){
                $this->redirect($this->referer());
                $this->Flash->error('Vous ne pouvez pas vous défier vous-même.');
            }
            else{
                $idactu = $this->request->getSession()->read('currUser');
                $assactu = $this->Duels->Associations
                    ->get($idactu);
                $association = $this->Duels->Associations
                    ->get($id);
                $newDefi = $this->Duels->newEntity();
                $allAssoc = $this->Duels->Associations->find()->select(['id', 'nom', 'domaine'])->toArray();
                $toJson = array();
                foreach($allAssoc as $key=>$assocTemp){
                    if($assocTemp->id == $id || $assocTemp->id == $this->request->getSession()->read('currUser')){
                        unset($allAssoc[$key]);
                    }
                }
                $ctp = 0;
                foreach($allAssoc as $assocTemp){
                    $toJson[$ctp]['title'] = $assocTemp->nom;
                    $toJson[$ctp]['description'] = $assocTemp->domaine;
                    $ctp++;
                }
                $jsonString = utf8_encode(json_encode($toJson));
                $this->set(compact('association'));
                $this->set(compact('assactu'));
                $this->set(compact('newDefi'));
                $this->set(compact('id'));
                $this->set(compact('jsonString'));
            }
        }
    }

    public function defy(){
        if($this->request->getSession()->read('currUser') == null){
            $this->redirect($this->referer());
            $this->Flash->error('Veuillez vous connecter avant d\'accéder à cette page.');
        }
        else{
            $data = $this->getRequest()->getData();
            foreach($data["Duels"] as $key=>$dat){
                if(!is_array($dat)){
                    $data["Duels"][$key] = htmlspecialchars($data["Duels"][$key]);
                }
            }
            $data['duelDate'] = FrozenTime::createFromFormat('Y-m-d H:i:s', $data['duelDate'], 'Europe/Paris');
            $data['isOver'] = false;
            $data['isAccepted'] = false;
            if($data['idAssoc2'] == $this->request->getSession()->read('currUser')){
                $this->redirect($this->referer());
                $this->Flash->error('Vous ne pouvez pas vous défier vous-même.');
            }
            else{
                $defi = $this->Duels->newEntity($data);
                if(!$this->Duels->save($defi)){
                    $this->redirect($this->referer());
                    $this->Flash->error('Erreur lors de l\'envoi de votre défi.');
                }
                else{

                    $assoc1 = $this->Duels->Associations->get($data['idAssoc2']);
                    $assoc2 = $this->Duels->Associations->get($this->request->getSession()->read('currUser'));
                    $this->Duels->Associations->link(
                        $defi,
                        [
                            $assoc1
                        ]
                    );
                    $this->Duels->Associations->link(
                        $defi,
                        [
                            $assoc2
                        ]
                    );
                    $ally = $this->Duels->Associations->find()->select()->where(['nom'=>$data['ally']])->first();
                    if($ally != null && $ally->nom != $assoc1->nom && $ally->nom != $assoc2->nom){
                        $allianceData = array();
                        $allianceData['id'] = 0;
                        $allianceData['association_id_1'] = $assoc2->id;
                        $allianceData['association_id_2'] = $ally->id;
                        $alliance = $this->Duels->Alliances->newEntity($allianceData);
                        $this->Duels->Alliances->save($alliance);
                        $alliance = $this->Duels->Alliances->find()->order(['id'=>'DESC'])->first();
                        $this->Duels->Alliances->link(
                            $defi,
                            [
                                $alliance
                            ]
                        );
                    }
                    $this->redirect('/');
                }
            }
        }
    }

    public function viewAll(){
        $currAssoc = $this->Duels->Associations->find()->select()->where(['id'=>$this->getRequest()->getSession()->read('currUser')])->contain(['Duels'])->first();
        $this->set(compact('currAssoc'));
    }

}
