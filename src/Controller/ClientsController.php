<?php
namespace App\Controller;

use App\Controller\AppController;

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
        //社員情報の新規登録/編集分岐
  		if($this->request->is('post')) {  
                $post = $this->Clients->newEntity($this->request->data);
                $clientsData = $this->Clients->find()->where(['person_no' => $post['person_no']])->first();
                //表示する文言を追加
                $title = "社員情報編集";
                $msg = "社員情報を修正してください";
                //画像表示用
                $id = $clientsData['person_no'];
                $pass = "<img src=/img/".$id.".jpg>";
                $name = $clientsData['name_initial'];
                $class = "hide";
        }
        else{   
                //表示する文言を追加
                $title = "社員情報登録";
                $msg = "社員情報を入力してください";
                $id = NULL;
                $pass = "";
                $name = NULL;
                $class = "del";
        }
        $this->set('id', $id);
        $this->set('name', $name);
        $this->set('class', $name);
  		$this->set('message', $msg);
        $this->set('title', $title);
        $this->set('pass', $pass);
        $this->set('entity', $this->Clients->newEntity());
    }

    public function addEmployeeRecord() {
    	if($this->request->is('post')) {
            //登録新規登録・変更処理
    		$post = $this->Clients->newEntity($this->request->data);
    		$this->Clients->save($post);
            //画像保存処理
            $fileName = $post['UploadData']['tmp_name'];
            $imgName = $post['person_no'].".jpg";
            move_uploaded_file($fileName,'img/'.$imgName);
            //編集画面に戻る
            return  $this->redirect(['action' => 'regist']);
    	}
    }

     public function delEmployeeRecord() {
        if($this->request->is('post')) {
            //レコード削除処理
            $post = $this->Clients->newEntity($this->request->data);
            $this->Clients->deleteAll(['person_no' => $post['person_no']]); 
            //画像削除処理
            file_exists('img/'.$post['person_no']);
            //ログイン画面に戻る
            return  $this->redirect(['action' => 'login']);
        }
    }

}