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
                $newDefi = $this->Duels->newEntity();
                $allAssoc = $this->Duels->Associations->find()->select(['id', 'nom', 'description'])->toArray();
                $toJson = array();
                foreach($allAssoc as $key=>$assocTemp){
                    if($assocTemp->id == $id || $assocTemp->id == $this->request->getSession()->read('currUser')){
                        unset($allAssoc[$key]);
                    }
                }
                $ctp = 0;
                foreach($allAssoc as $assocTemp){
                    $toJson[$ctp]['title'] = $assocTemp->nom;
                    $toJson[$ctp]['description'] = $assocTemp->description;
                    $ctp++;
                }
                $jsonString = utf8_encode(json_encode($toJson));
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

}