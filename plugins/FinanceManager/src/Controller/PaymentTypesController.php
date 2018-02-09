<?php
namespace FinanceManager\Controller;

use FinanceManager\Controller\AppController;

/**
 * PaymentTypes Controller
 *
 * @property \FinanceManager\Model\Table\PaymentTypesTable $PaymentTypes
 *
 * @method \FinanceManager\Model\Entity\PaymentType[] paginate($object = null, array $settings = [])
 */
class PaymentTypesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $paymentTypes = $this->paginate($this->PaymentTypes);

        $this->set(compact('paymentTypes'));
        $this->set('_serialize', ['paymentTypes']);
    }

    /**
     * View method
     *
     * @param string|null $id Payment Type id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $paymentType = $this->PaymentTypes->get($id, [
            'contain' => ['Payments']
        ]);

        $this->set('paymentType', $paymentType);
        $this->set('_serialize', ['paymentType']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $paymentType = $this->PaymentTypes->newEntity();
        if ($this->request->is('post')) {
            $paymentType = $this->PaymentTypes->patchEntity($paymentType, $this->request->getData());
            if ($this->PaymentTypes->save($paymentType)) {
                $this->Flash->success(__('The payment type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment type could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentType'));
        $this->set('_serialize', ['paymentType']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Payment Type id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $paymentType = $this->PaymentTypes->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $paymentType = $this->PaymentTypes->patchEntity($paymentType, $this->request->getData());
            if ($this->PaymentTypes->save($paymentType)) {
                $this->Flash->success(__('The payment type has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The payment type could not be saved. Please, try again.'));
        }
        $this->set(compact('paymentType'));
        $this->set('_serialize', ['paymentType']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Payment Type id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $paymentType = $this->PaymentTypes->get($id);
        if ($this->PaymentTypes->delete($paymentType)) {
            $this->Flash->success(__('The payment type has been deleted.'));
        } else {
            $this->Flash->error(__('The payment type could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
