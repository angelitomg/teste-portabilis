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
     * Pay method
     *
     * @param int $id Registration Payment id.
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function pay($id)
    {
        // Get payment info
        $payment = $this->RegistrationPayments
            ->find('all')
            ->where(['RegistrationPayments.id' => $id])
            ->contain(['Registrations' => ['Courses', 'Students']])
            ->first();

        // Check if is a valid payment
        if (empty($payment) || $payment->status == 1) return $this->redirect(['controller' => 'Registrations', 'action' => 'index']);

        // Payback amount
        $payback = [];
        
        // Pay action
        if ($this->request->is(['post', 'put'])) {
            
            // Get data
            $paymentDate = $this->request->data['payment_date']['year'] . '-' .
                    $this->request->data['payment_date']['month'] . '-' .
                    $this->request->data['payment_date']['day'];
            $amountPaid = $this->request->data['amount_paid'];

            // Check payment amount
            if ($payment->amount > $amountPaid) {
                $this->Flash->error(__('Invalid amount.'));
            } else {

                // Set data and save payment
                $payment->payment_date = $paymentDate;
                $payment->status = 1;
                $this->RegistrationPayments->save($payment);

                // Update registration if is registration tax
                if ($payment->number == 0) {
                    $this->loadModel('Registrations');
                    $registration = $this->Registrations
                        ->find('all')
                        ->where(['Registrations.id' => $payment->registration_id])
                        ->first();
                    if (empty($registration)) return null;
                    $registration->registration_tax_paid = 1;
                    $this->Registrations->save($registration);
                }

                // Calculate payback
                $amountPaid = str_replace('.', '', $amountPaid);
                $amountPaid = str_replace(',', '', $amountPaid);
                $amountPaid = $amountPaid / 100;
                $amountPaid = round($amountPaid, 2);
                $payback = $this->_calculatePayback($payment->amount, $amountPaid);
                if (empty($payback)) return $this->redirect(['controller' => 'Registrations', 'action' => 'view', $payment->registration_id]);

            }
            
        }

        $this->set(compact('payment', 'payback'));
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

    /**
     * Calculate payback method
     *
     * @param float $amount Total amount.
     * @param float $amountPaid Amount paid.
     * @return mixed
     */
    private function _calculatePayback($amount, $amountPaid) {
        // Notes and totals
        $notes = [100, 50, 10, 5];
        $cents = [100, 50, 10, 5, 1];
        $totals = [];

        // Get payback value
        $payback = $amountPaid - $amount;
        $value = $payback;

        // Check each money
        foreach ($notes as $note) {
            $totalNotes = 0;
            $totalNotes = floor($value / $note);
            if ($totalNotes > 0) {
                $value = $value - ($totalNotes * $note);
                $totals[(string) $note] = $totalNotes;  
            }
        }

        // Check each cents
        $value = $value * 100;
        foreach ($cents as $cent) {
            $value = round($value, 2);
            $totalCents = 0;
            $totalCents = floor($value / $cent);
            if ($totalCents > 0) {
                $value = $value - ($totalCents * $cent);
                $totals[(string) ($cent/100)] = $totalCents;    
            }
        }

        // Return totals
        return $totals;

    }

}
