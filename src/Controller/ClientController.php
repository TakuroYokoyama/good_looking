<?php
namespace App\Controller;

use App\Controller\AppController;

class ClientController extends AppController{
    public function initialize(){
        $this->name = "Client";
        $this->autoRender = true;
        $this->viewBuilder()->autoLayout(false);
    }

    public function index() {  
        return $this->redirect(['action' => "login"]);
    }

    public function login() {  
        $id = $this->request->data('id');
        $pass = $this->request->data('pass');
        
        //ログインできるユーザ・パスワードを固定
        $idAdmin = "administrator";
        $passAdmin = "admin";

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
}