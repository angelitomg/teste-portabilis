<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\I18n\Number;

/**
 * Registrations Controller
 *
 * @property \App\Model\Table\RegistrationsTable $Registrations
 *
 * @method \App\Model\Entity\Registration[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class RegistrationsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Students', 'Courses']
        ];
        $registrations = $this->paginate($this->Registrations);

         // Paginate configs
        $this->paginate = [
            'contain' => ['Students', 'Courses'],
            'sortWhitelist' => ['id', 'Courses.name', 'Students.name', 'year', 'active', 'registration_tax_paid'],
            'order' => ['id' => 'DESC']
        ];
        $where = [];

        // Course filter
        if (!empty($this->request->query['course_name'])) {
            $where['Courses.name LIKE'] = "%{$this->request->query['course_name']}%";
        }

        // Student filter
        if (!empty($this->request->query['student_name'])) {
            $where['Students.name LIKE'] = "%{$this->request->query['student_name']}%";
        }

        // Year filter
        if (!empty($this->request->query['year'])) {
            $where['Registrations.year'] = $this->request->query['year'];
        }

        // Active filter
        if ((isset($this->request->query['active'])) && 
            ($this->request->query['active'] == 0 || $this->request->query['active'] == 1)) {
            $where['Registrations.active'] = $this->request->query['active'];
        } else {
            $where['Registrations.active'] = 1;
        }

        // Registration tax paid filter
        if ((isset($this->request->query['registration_tax_paid'])) && 
            ($this->request->query['registration_tax_paid'] == 0 || $this->request->query['registration_tax_paid'] == 1)) {
            $where['Registrations.registration_tax_paid'] = $this->request->query['registration_tax_paid'];
        }

        // Get registrations
        $query = $this->Registrations->find('all')->contain(['Courses', 'Students'])->where($where);

        // Paginate results
        $registrations = $this->paginate($query);

        $activeOptions = [0 => __('Inactives'), 1 => __('Actives'), 2 => __('All')];
        $registrationTaxPaidOptions = [0 => __('Not Paid'), 1 => __('Paid'), 2 => __('All')];

        $this->set(compact('registrations', 'registrationTaxPaidOptions', 'activeOptions'));
    }

    /**
     * View method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $registration = $this->Registrations->get($id, [
            'contain' => ['Students', 'Courses', 'RegistrationPayments' => ['sort' => ['RegistrationPayments.id' => 'ASC']]]
        ]);

        $this->set('registration', $registration);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $registration = $this->Registrations->newEntity();
        if ($this->request->is('post')) {

            $registration = $this->Registrations->patchEntity($registration, $this->request->getData());

            // Search for a date conflict
            if ($this->_hasPeriodConflict($registration->course_id, $registration->student_id, $registration->year)) {
                $this->Flash->error(__('It was not possible complete registration. The student already has a course in the same period.'));
            } else {

                // Set inicial status
                $registration->active = true;
                $registration->registration_tax_paid = false;

                // Save registration
                if ($this->Registrations->save($registration)) {

                    // Generate payments
                    $this->_generatePayments($registration->id);

                    $this->Flash->success(__('The registration has been saved.'));
                    return $this->redirect(['action' => 'view', $registration->id]);
                }
                $this->Flash->error(__('The registration could not be saved. Please, try again.'));

            }

        }
        //$students = $this->Registrations->Students->find('list', ['order' => ['Students.name' => 'ASC']]);
        $courses = $this->Registrations->Courses->find('list', ['order' => ['Courses.name' => 'ASC']]);
        $this->set(compact('registration', 'courses'));
    }

    /**
     * Cancel method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function cancel($id = null)
    {
        // Only allow...
        $this->request->allowMethod(['post', 'delete']);

        // Get registration data
        $registration = $this->Registrations
            ->find('all')
            ->where(['Registrations.id' => $id, 'Registrations.active' => 1])
            ->contain(['RegistrationPayments'])
            ->first();

        // Check invalid registration
        if (empty($registration)) return $this->redirect('/');

        // Get all incompleted payments
        $cancellationFee = 0;
        if (!empty($registration->registration_payments)) {
            foreach ($registration->registration_payments as $payment) {
                if (empty($payment->payment_date)) {

                    // Increase cancellation fee
                    $cancellationFee += ($payment->amount / 100) * 1;

                }
            }
        }

        // Set cancellation date and save registration
        $registration->cancellation_date = date('Y-m-d');
        $registration->active = false;
        $this->Registrations->save($registration);

        // Set status message and redirect
        $this->Flash->success(__('Registration cancelled successfully. The cancellation fee is ') . Number::currency($cancellationFee) . '.');
        return $this->redirect(['action' => 'view', $id]);
    
    }

    /**
     * Delete method
     *
     * @param string|null $id Registration id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $registration = $this->Registrations->get($id);
        if ($this->Registrations->delete($registration)) {
            $this->Flash->success(__('The registration has been deleted.'));
        } else {
            $this->Flash->error(__('The registration could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Generate payments method
     *
     * @param int $id Registration id.
     * @return \Cake\Http\Response|null Redirects to view.
     */
    public function generatePayments($id)
    {
        $this->request->allowMethod(['post']);
        $registration = $this->Registrations
            ->find('all')
            ->where(['Registrations.id' => $id])
            ->contain(['RegistrationPayments'])
            ->first();
        if (!empty($registration) && empty($registration->registration_payments)) {
            $this->_generatePayments($registration->id);
            $this->Flash->success(__('Payments generated successfully.'));
        } else {
            $this->Flash->error(__('The payments could not be generated. '));
        }
        return $this->redirect(['action' => 'view', $registration->id]);
    }

    /**
     * _hasPeriodConflict method
     *
     * @param int $course_id Course id.
     * @param int $student_id Student id.
     * @param int $year Course year.
     * @return boolean 
     */
    private function _hasPeriodConflict($course_id, $student_id, $year)
    {

        // Where conditions
        $conditions = [
            'Registrations.course_id' => $course_id, 
            'Registrations.student_id' => $student_id, 
            'Registrations.year' => $year
        ];

        // Get all records
        $registrations = $this->Registrations->find('all')->where($conditions)->toArray();

        // Check if user has a registration in same period
        return (!empty($registrations)) ? true : false;

    }

    /**
     * _generatePayments method
     *
     * @param int $id Registration id.
     * @return mixed
     */
    private function _generatePayments($id)
    {

        // Load payments model
        $this->loadModel('RegistrationPayments');

        // Get registration info
        $registration = $this->Registrations
            ->find('all')
            ->where(['Registrations.id' => $id])
            ->contain(['Courses'])
            ->first();

        // Check invalid registration
        if (empty($registration)) return false;
        if (!$registration->has('course')) return false;

        // Generate registration tax
        $registrationTax = $this->RegistrationPayments->newEntity();
        $registrationTax->registration_id = $id;
        $registrationTax->amount = $registration->course->registration_tax;
        $registrationTax->date = date('Y-m-d');
        $registrationTax->due_date = date('Y-m-d', strtotime('+30 days'));
        $registrationTax->payment_date = NULL;
        $registrationTax->number = 0;
        $registrationTax->is_registration_tax = 1;
        $registrationTax->status = 0;
        if (!$this->RegistrationPayments->save($registrationTax)) return false;

        // Generate monthly payments
        $nextDueDate = date('Y-m-d', strtotime('+30 days'));
        for ($i = 1; $i <= $registration->course->duration; $i++) {
            $registrationPayment = $this->RegistrationPayments->newEntity();
            $registrationPayment->registration_id = $id;
            $registrationPayment->amount = $registration->course->monthly_amount;
            $registrationPayment->date = date('Y-m-d');
            $registrationPayment->due_date = $nextDueDate;
            $registrationPayment->payment_date = NULL;
            $registrationPayment->number = $i;
            $registrationPayment->is_registration_tax = 0;
            $registrationPayment->status = 0;
            if (!$this->RegistrationPayments->save($registrationPayment)) return false;
            $nextDueDate = date('Y-m-d', strtotime($nextDueDate . ' +30 days'));
        }

        return true;

    }

}
