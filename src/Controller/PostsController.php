<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\ORM\TableRegistry;
 
class PostsController extends AppController {
	public function initialize() {
        // postsテーブルとEmployeesテーブルを使用するためTableRegistryでインスタンスを作成する
        parent::initialize();
        // $this->Posts = TableRegistry::get('posts');
        $this->Employees = TableRegistry::get('employees');
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('post');
	}
    public function index() {
        // 社員テーブルから現在の社員数を取得
        $data = $this->Employees->find('all', [
            'conditions'=>['del_flg = 0']
            ]);
        $list = array();
        for($i = 1;$i <= ($data->count());$i++) {
            array_push($list,$i);
        }
        // 並び順で有利不利の無いようシャッフルする
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
        $employee = $this->Employees->find('all', [
            'conditions'=>['del_flg = 0']
            ]);
        $data = $this->Posts->find('all');
        $count = array();
        $img = array();
        for($i = 1;$i <= ($employee->count());$i++) {
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
