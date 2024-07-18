<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Verbs Controller
 *
 * @property \App\Model\Table\VerbsTable $Verbs
 */
class VerbsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->Verbs->find();
        $verbs = $this->paginate($query);

        $this->set(compact('verbs'));
    }

    /**
     * View method
     *
     * @param string|null $id Verb id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $verb = $this->Verbs->get($id, contain: []);
        $this->set(compact('verb'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $verb = $this->Verbs->newEmptyEntity();
        if ($this->request->is('post')) {
            $verb = $this->Verbs->patchEntity($verb, $this->request->getData());
            if ($this->Verbs->save($verb)) {
                $this->Flash->success(__('The verb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The verb could not be saved. Please, try again.'));
        }
        $this->set(compact('verb'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Verb id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $verb = $this->Verbs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $verb = $this->Verbs->patchEntity($verb, $this->request->getData());
            if ($this->Verbs->save($verb)) {
                $this->Flash->success(__('The verb has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The verb could not be saved. Please, try again.'));
        }
        $this->set(compact('verb'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Verb id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $verb = $this->Verbs->get($id);
        if ($this->Verbs->delete($verb)) {
            $this->Flash->success(__('The verb has been deleted.'));
        } else {
            $this->Flash->error(__('The verb could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function import(){

        $this->request->allowMethod(['post']);

        $attachment = $this->request->getData('json');
        $name = $attachment->getClientFilename();
        // $type = $attachment->getClientMediaType();
        // $size = $attachment->getSize();
        // $tmpName = $attachment->getStream()->getMetadata('uri');
        // $error = $attachment->getError();
        $targetPath = WWW_ROOT.DS.'uploads'.DS.$name;

        $attachment->moveTo($targetPath);
        $content = json_decode(file_get_contents($targetPath));

        // debug($content);
        // exit();

        if(!empty($content)):
            foreach($content as $v):
                $match = $this->Verbs->find()->where(['infinitive' => $v->infinitive])->first();
                $verb = (!empty($match)) ? $this->Verbs->get($v->id) : $this->Verbs->newEmptyEntity() ;
                
                $verb->infinitive = $v->infinitive;
                $verb->preterit = $v->preterit;
                $verb->past_participle = $v->past_participle;
                $verb->translation = $v->translation;

                $this->Verbs->save($verb);
            endforeach;
        endif;

        if(file_exists($targetPath)):
            unlink($targetPath);
        endif;

        return $this->redirect(['action' => 'index']);
    }
}
