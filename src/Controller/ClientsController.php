<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;

class ClientsController extends AppController{
    public function initialize(){
        ////cakephpデフォルトデザイン初期化
        $this->name = "Clients";
        $this->autoRender = true;
        $this->viewBuilder()->autoLayout(false);
    }

    public function index() {
        //login画面にリダイレクトする(method名とctp名をあわせるため)  
        return $this->redirect(['action' => "login"]);
    }

    public function login() {  
        $id = $this->request->data('id');
        $pass = $this->request->data('pass');
        
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

    public function detail(){
        if($this->request->is('post')) {
            //社員番号取得
            $id = $this->request->data('person_no');
         }
         else{
            //不正アクセスの場合、ログイン画面に戻す
            return  $this->redirect(['action' => 'login']);
        }
        //社員情報取得
        $clientsData = $this->Clients->find()->where(['person_no' => $id])->first();
        $connection = ConnectionManager::get('default');
        $postsData = $connection->query('SELECT COUNT(*) AS votes FROM posts WHERE person_no = '.$id.';')->fetchAll('assoc');

        //表示値をセット
        $this->set('id', $clientsData['person_no']);
        $this->set('name', $clientsData['name_initial']);
        $this->set('return', $clientsData['press_return']);
        $this->set('vote', $postsData[0]['votes']);
        $this->set('entity', $this->Clients->newEntity());
    }
}