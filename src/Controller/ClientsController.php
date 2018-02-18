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
        $results = $connection->query('SELECT c.name_initial, COUNT(*) 
                                        FROM posts p 
                                        INNER JOIN clients c 
                                        ON p.person_no = c.person_no GROUP BY p.person_no;')->fetchAll('assoc');    

        $labels = array();
        $graphDatas = array();
        foreach ($results as $result) {
            array_push($labels, "\"".$result['name_initial']."\"");
            array_push($graphDatas, (int)$result['COUNT(*)']);
        }

        $labels = implode(",", $labels);
        $graphDatas = implode(",", $graphDatas);

        $this->set("labels", $labels);
        $this->set("graphDatas", $graphDatas);

        // if($this->request->is('post')){
        //     $dataFilterName = $this->request->data('dataFilter');

        //     if($dataFilterName === 'desc'){
        //         $results = $this->$connection->execute('SELECT * FROM posts')->fetchAll('assoc');
        //         print_r($results);

        //     } elseif($dataFilterName === 'asc'){

        //     } elseif($dataFilterName === 'man'){

        //     } elseif($dataFilterName === 'woman'){

        //     }
        // }
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