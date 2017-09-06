<?php
App::uses('AppController', 'Controller');
class QuestionController extends AppController {
    public $components=array('Core');
    public $helper = array('General');
    public $uses = array('QuestionOption','Question');

    function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow(array(''));
    }

    public function company_index() {
        $pageVar['title'] = 'Questions';
        $pageVar['sub_title'] = 'List of question';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Questions</li>';

        $conditions = array();
        $limit = 10;
        $qOptions = $this->Question->getQuestions(true,$conditions,$limit);
        $this->paginate = $qOptions;
        $Questions = $this->paginate('Question');
        $this->set(compact('Questions','pageVar'));
    }

    public function company_add() {
        $pageVar['title'] = 'Add Question';
        $pageVar['sub_title'] = 'Add new question';
        $pageVar['breadcrumb'] = '<li><a href="'.COMPANY_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Add Question</li>';
        if ($this->request->is('post')) {
            $answers = $this->request->data['Question']['Answers'];
            if ($this->Question->addQuestion($this->request->data)) {
                $questionId = $this->Question->getLastInsertId();
                $answerData = array();
                foreach ($answers as $key => $value) {
                    $answerData[$key] = array(
                        'question_id'=>$questionId,
                        'answer'=>$value['answer'][0],
                        'is_correct'=>$value['is_correct'][0]
                    );
                }

                $this->QuestionOption->saveAll($answerData);

                $this->Session->setFlash(__('The question has been added'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The question could not be added. Please, try again.'),'default',array('class'=>'alert alert-danger'));
            }
        }
        $this->set('pageVar',$pageVar);
    }

    public function company_edit($id = null) {
        $pageVar['title'] = 'Edit Question';
        $pageVar['sub_title'] = 'Edit question details';
        $pageVar['breadcrumb'] = '<li><a href="'.ADMIN_WEBROOT.'"><i class="fa fa-dashboard"></i> Home</a></li><li class="active">Edit Question</li>';
       
        $this->Question->id = $id;
        $conditions = array('Question.id'=>$id);
        $limit = 10;
        $QuestionDetails = $this->Question->getQuestions(false,$conditions,$limit);
        $pageVar['blockCount'] = $this->Core->findCount('QuestionOption',array('QuestionOption.question_id'=>$id));
        $data = $QuestionDetails[0];
        
        if (!$this->Question->exists()) {
            throw new NotFoundException(__('Invalid Question'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            $answers = $this->request->data['Question']['Answers'];
            if ($this->Question->updateQuestion($this->request->data)) {
                $questionId = $id;
                $answerData = array();
                foreach ($answers as $key => $value) {
                    $answerData[$key] = array(
                        'question_id'=>$questionId,
                        'answer'=>$value['answer'][0],
                        'is_correct'=>$value['is_correct'][0]
                    );
                }
                $this->QuestionOption->deleteAll(array('QuestionOption.question_id'=>$questionId));
                $this->QuestionOption->saveAll($answerData);
                $this->Session->setFlash(__('The Question has been updated'),'default',array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Question could not be updated. Please, try again.'),'default',array('class'=>'error'));
            }
        } else {
            $this->request->data = $data;
        }
        $this->set('pageVar',$pageVar);
        $this->render('company_add');
    }

    public function get_answers(){
        $this->layout = false;
        if($this->request->is('post')){
            $pageVar['block'] = $this->request->data['block'];
        }
        $this->set('pageVar',$pageVar);
        $this->render('get_answer');
    }

    public function render_answers(){
        $this->layout = false;
        if($this->request->is('post')){
            $questionId = $this->request->data['question_id'];
            $questOpts = $this->QuestionOption->find('all',array('conditions'=>array('QuestionOption.question_id'=>$questionId)));
            $pageVar['questOpts'] = $questOpts;
        }

        $this->set('pageVar',$pageVar);
        $this->render('render_answer');
    }
}
