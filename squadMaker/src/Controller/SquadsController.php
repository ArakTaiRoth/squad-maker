<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Squads Controller
 *
 * @property \App\Model\Table\SquadsTable $Squads
 *
 * @method \App\Model\Entity\Squad[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SquadsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $squads = $this->Squads->getSquads();

        $this->set(compact('squads'));
    }

    /**
     * View method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $squad = $this->Squads->get($id, [
            'contain' => ['Players']
        ]);

        $this->set('squad', $squad);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $response = $this->Squads->createSquads($this->request->getData('squadCount'));

            if ($response['type'] === 'success') {
                $this->Flash->success($response['message']);

                $this->setAction('index');
            } else {
                $this->Flash->error($response['message']);
            }
        } else {
            return $this->redirect(['controller' => 'Players', 'action' => 'index']);
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $squad = $this->Squads->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $squad = $this->Squads->patchEntity($squad, $this->request->getData());
            $name = $squad->name;

            if ($this->Squads->save($squad)) {
                $this->Flash->success("$name has been edited");

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error("$name could not be edited");
        }

        $this->set(compact('squad'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Squad id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $squad = $this->Squads->get($id);
        if ($this->Squads->delete($squad)) {
            $this->Flash->success(__('The squad has been deleted.'));
        } else {
            $this->Flash->error(__('The squad could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function reset() {
        if ($this->Squads->deleteAll([1 => 1])) {
            $this->Flash->success('All squads have been reset');
        } else {
            $this->Flash->error('There was an error resetting the squads');
        }

        return $this->redirect(['controller' => 'Players', 'action' => 'index']);
    }
}
