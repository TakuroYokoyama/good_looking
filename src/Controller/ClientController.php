<?php
namespace App\Controller;

use App\Controller\AppController;

class ClientController extends AppController{
    public function initialize(){
        ////cakephpデフォルトデザイン初期化
        $this->name = "Client";
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
            return ;
    	}
    }

}