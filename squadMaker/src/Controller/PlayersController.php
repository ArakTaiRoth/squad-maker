<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Players Controller
 *
 * @property \App\Model\Table\PlayersTable $Players
 *
 * @method \App\Model\Entity\Player[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class PlayersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $players = $this->Players->getPlayers();
        $squadCount = $this->Players->Squads->getSquadCount();

        $this->set(compact('players', 'squadCount'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $player = $this->Players->newEntity();
        if ($this->request->is('post')) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            if ($this->Players->save($player)) {
                $this->Flash->success(__('The player has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The player could not be saved. Please, try again.'));
        }
        $squads = $this->Players->Squads->find('list', ['limit' => 200]);
        $this->set(compact('player', 'squads'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $player = $this->Players->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $player = $this->Players->patchEntity($player, $this->request->getData());
            $player->total = $player->shooting + $player->skating + $player->checking;
            $name = $player->firstName . ' ' . $player->lastName;

            if ($this->Players->save($player)) {
                $this->Flash->success("$name has been edited.");

                return $this->redirect(['action' => 'index']);
            }

            $this->Flash->error("$name could not be edited.");
        }

        $this->set(compact('player'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Player id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $player = $this->Players->get($id);
        $name = $player->firstName . ' ' . $player->lastName;

        if ($this->Players->delete($player)) {
            $this->Flash->success("Player $name has been deleted.");
        } else {
            $this->Flash->error("Player $name could not be deleted.");
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Import method
     *
     * @return \Cake\Http\Response|null Redirects to dashboard on successfull import, renders view otherwise
     */
    public function import() {
        if ($this->request->is('post')) {
            $this->loadComponent('Upload');
            $this->loadComponent('Parse');

            if ($this->request->getData('playerFile') !== null) {
                $response = $this->Upload->upload($this->request->getData('playerFile'));

                if ($response['type'] === 'success') {
                    $response = $this->Parse->parsePlayerJson($response['file']);
                }
            } else if ($this->request->getData('api') === '1') {
                $response = $this->Players->getResponse('players');

                // Check if an error was returned from the curl request
                if ($response['type'] === 'success') {
                    $response = $this->Players->createPlayers($response['data']);
                }
            } else {
                // An invalid form request was sent, reload the page
                return $this->redirect(['action' => 'import']);
            }

            if ($response['type'] === 'success') {
                $this->Flash->success($response['message']);

                $this->setAction('index');
            } else {
                $this->Flash->error($response['message']);
            }
        }
    }
}
