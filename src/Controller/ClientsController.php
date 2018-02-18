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
        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $clients = $this->Clients->find('all');

        $this->set("clients", $clients);
        $this->set("labels", "1");
        $this->set("graphData", "1");
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