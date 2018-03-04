<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class ClientsController extends AppController{
    public function initialize(){
        //cakephpデフォルトデザイン初期化
        $this->name = "Clients";
        $this->autoRender = true;
        $this->viewBuilder()->autoLayout(false);
        header('Content-Type: application/json');
    }

    public function index() {
        //login画面にリダイレクトする(method名とctp名をあわせるため)  
        return $this->redirect(['action' => "login"]);
    }

    public function login() {  
        $id = $this->request->data('id');
        $pass = $this->request->data('pass');
        $connection = ConnectionManager::get('default');
        
        //ログインできるユーザ・パスワードを固定
        $idAdmin = "administrator";
        $passAdmin = "admin";

        //ログインチェック
        if($this->request->is('post')){
            if( strcmp($id,$idAdmin) == 0 && strcmp($pass,$passAdmin) == 0){
                return $this->redirect(['action' => "aggregate"]);
             }else{
                $this->set("loginErrMessage","ログイン失敗");
             }
         }
    }

    public function aggregate() {  
        $this->viewBuilder()->className('Aggregate');

        $connection = ConnectionManager::get('default');
        $results = $connection->query('SELECT c.name_initial, COUNT(*) as vote
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            GROUP BY p.person_no
                                            ORDER BY vote DESC;')->fetchAll('assoc');    

        $labels = array();
        $graphDatas = array();
        foreach ($results as $result) {
            array_push($labels, "\"".$result['name_initial']."\"");
            array_push($graphDatas, $result['vote']);
        }

        $labels = implode(",", $labels);
        $graphDatas = implode(",", $graphDatas);

        $this->set("labels", $labels);
        $this->set("graphData", $graphDatas);
    }

    public function sortGraph(){
        $this->viewBuilder()->className('Aggregate');

        $sortType = $_POST['filter'];

        if($sortType === 'desc'){
            $connection = ConnectionManager::get('default');
            $results = $connection->query('SELECT c.name_initial, COUNT(*) as vote
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            GROUP BY p.person_no
                                            ORDER BY vote DESC;')->fetchAll('assoc');
        } elseif($sortType === 'asc'){
            $connection = ConnectionManager::get('default');
            $results = $connection->query('SELECT c.name_initial, COUNT(*) as vote 
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            GROUP BY p.person_no
                                            ORDER BY vote ASC;')->fetchAll('assoc');
        } elseif($sortType === 'man'){
            $connection = ConnectionManager::get('default');
            $results = $connection->query('SELECT p.id, p.gender, c.name_initial, COUNT(*) as vote 
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            WHERE gender = 0
                                            GROUP BY p.person_no
                                            ORDER BY vote DESC;')->fetchAll('assoc');
        } elseif($sortType === 'woman'){
            $connection = ConnectionManager::get('default');
            $results = $connection->query('SELECT p.id, p.gender, c.name_initial, COUNT(*) as vote 
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            WHERE gender = 1
                                            GROUP BY p.person_no
                                            ORDER BY vote DESC;')->fetchAll('assoc');
        }

        $labels = array();
        $graphDatas = array();
        foreach ($results as $result) {
            array_push($labels, "\"".$result['name_initial']."\"");
            array_push($graphDatas, $result['vote']);
        }

        $labels = implode(",", $labels);
        $graphDatas = implode(",", $graphDatas);

        $this->set("labels", $labels);
        $this->set("graphDatas", $graphDatas);
        echo json_encode($results);

        $this->autoRender = false;
    }

    public function regist()
    {
    	$str = $this->request->data('initial');
  		$msg = $str;
  		if ($str == null) 
    		{ $msg = "登録したい社員情報を入力してください"; }
  		$this->set('message', $msg);
    }

    public function addEmployeeRecord() {
    	if($this->request->is('post')) {
    		$post = $this->Clients->newEntity($this->request->data);
    		$this->Clients->save($post);
            return  $this->redirect(['action' => 'regist']);
    	}
    }

}