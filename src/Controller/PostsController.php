<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use \Exception;

class PostsController extends AppController {
	public function initialize() {
        // postsテーブルとclientsテーブルを使用するためTableRegistryでインスタンスを作成する
        parent::initialize();
        // $this->Posts = TableRegistry::get('posts');
        $this->Clients = TableRegistry::get('clients');
		$this->viewBuilder()->autoLayout(true);
		$this->viewBuilder()->layout('post');
        $this->loadComponent('Flash');
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
        $person_no = $this->request->query('value');
    	$imgpath = $person_no. '.jpg';
    	$this->set('imgpath', $imgpath);
    	$this->set('person_no', $person_no);
    }

    public function addRecord() {
        $record = $this->Posts->newEntity();
        $record->person_no = $this->request->data['person_no'];
        $record->roc_x = $this->request->data['roc_x'];
        $record->roc_y = $this->request->data['roc_y'];
        $record->name_initial = $this->request->data['f_name'].'・'.$this->request->data['l_name'];
        $record->univ = h($this->request->data['univ']);
        $record->gender = $this->request->data['gender'];
        $record->date = date("Y/m/d H:i:s");
        
    	try {
            $this->Posts->save($record);
            return $this->redirect(['action' => 'complete']);
        } catch (PDOException $e) {
            $this->Flash->error('あれれ〜？登録できないよ〜？（コナン君風に）'. $e->getMessage());
            return $this->redirect(['action' => 'index']);
        } 
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
