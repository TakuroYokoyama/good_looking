<?php
namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController {
	public function initialize() {
		$this->name = 'Posts';
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('post');
	}
    public function index() {
        $list = array(1,2,3,4,5,6,7,8);
        shuffle($list);
        $this->set('list', $list);
    }

    public function vote() {
    	$data = $this->Posts->find('all');
    	$imgpath = $this->request->query('value') . '.jpg';
    	$person_no = $this->request->query('value');
    	$this->set('data', $data);
    	$this->set('imgpath', $imgpath);
    	$this->set('person_no', $person_no);
    	$this->set('entity', $this->Posts->newEntity());
    }

    public function addRecord() {
    	if($this->request->is('post')) {
    		$post = $this->Posts->newEntity($this->request->data);
    		$this->Posts->save($post);
            return $this->redirect(['action' => 'complete']);
    	}
    }

    public function result() {
        $data = $this->Posts->find('all');
        $count = array();
        $img = array();
        for($i = 1;$i < 9;$i++) {
            $check = $this->Posts->findAllByPerson_no($i);
            if($check != null) {
                $count[$i] = $check->count();
                $img[$i] = $check;
            }
        }
        $this->set('count', $count);
        $this->set('img', $img);
    }

    public function complete() {

    }
}
