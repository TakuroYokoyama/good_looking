<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;

class PostsController extends AppController {
	public function initialize() {
        // postsテーブルとclientsテーブルを使用するためTableRegistryでインスタンスを作成する
        parent::initialize();
        // $this->Posts = TableRegistry::get('posts');
        $this->Clients = TableRegistry::get('clients');
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('post');
	}
    public function index() {
        // Clientsテーブルから現在の社員数(del_flg=0)を取得
        $data = $this->Clients->findByDelFlg(0);

        // person_noの配列を作成する
        $list = array();
        foreach ($data as $result) {
            array_push($list, $result['person_no']);
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
        //univ = $this->request->data('univ');
       // $name_initial = $this->request->data('name_initial');
        $record = $this->Posts->newEntity();//newEntityでテーブルの形。フォームから受け取った値。いま操作しているインスタンス。newEntityでテーブルの形。
        $record->person_no = $this->request->data['person_no'];
        $record->univ = $this->request->data['univ'];
        $record->date = $this->request->data['date'];
        $record->gender = $this->request->data['gender'];
        $record->roc_x = $this->request->data['roc_x'];
        $record->roc_y = $this->request->data['roc_y'];
        $record->name_initial = $this->request->data['f_name'].'・'.$this->request->data['l_name'];
    	$this->Posts->save($record);
        return $this->redirect(['action' => 'complete']);
    	}


    public function result() {
        $client = $this->Clients->find('all', [
            'conditions'=>['del_flg = 0']
            ]);
        $data = $this->Posts->find('all');
        $count = array();
        $img = array();
        for($i = 1;$i <= ($client->count());$i++) {
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
