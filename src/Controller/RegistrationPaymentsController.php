<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * RegistrationPayments Controller
 *
 * @property \App\Model\Table\RegistrationPaymentsTable $RegistrationPayments
 *
 * @method \App\Model\Entity\RegistrationPayment[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistrationPaymentsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Registrations']
        ];
        $registrationPayments = $this->paginate($this->RegistrationPayments);

        $this->set(compact('registrationPayments'));
    }

    /**
     * View method
     *
     * @param string|null $id Registration Payment id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registrationPayment = $this->RegistrationPayments->get($id, [
            'contain' => ['Registrations']
        ]);

        $this->set('registrationPayment', $registrationPayment);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registrationPayment = $this->RegistrationPayments->newEntity();
        if ($this->request->is('post')) {
            $registrationPayment = $this->RegistrationPayments->patchEntity($registrationPayment, $this->request->getData());
            if ($this->RegistrationPayments->save($registrationPayment)) {
                $this->Flash->success(__('The registration payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registration payment could not be saved. Please, try again.'));
        }
        $registrations = $this->RegistrationPayments->Registrations->find('list', ['limit' => 200]);
        $this->set(compact('registrationPayment', 'registrations'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Registration Payment id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $registrationPayment = $this->RegistrationPayments->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $registrationPayment = $this->RegistrationPayments->patchEntity($registrationPayment, $this->request->getData());
            if ($this->RegistrationPayments->save($registrationPayment)) {
                $this->Flash->success(__('The registration payment has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The registration payment could not be saved. Please, try again.'));
        }
        $registrations = $this->RegistrationPayments->Registrations->find('list', ['limit' => 200]);
        $this->set(compact('registrationPayment', 'registrations'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Registration Payment id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registrationPayment = $this->RegistrationPayments->get($id);
        if ($this->RegistrationPayments->delete($registrationPayment)) {
            $this->Flash->success(__('The registration payment has been deleted.'));
        } else {
            $this->Flash->error(__('The registration payment could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
