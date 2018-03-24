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

    
    /**
    *    ログイン画面
    */
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

    /**
    *    グラフ画面
    */
    public function aggregate() {  
        $this->viewBuilder()->className('Aggregate');

        $connection = ConnectionManager::get('default');
        $results = $connection->query('SELECT c.name_initial, COUNT(*) as vote, c.person_no
                                            FROM posts p 
                                            INNER JOIN clients c 
                                            ON p.person_no = c.person_no 
                                            GROUP BY p.person_no
                                            ORDER BY vote DESC;')->fetchAll('assoc');    

        $labels = array();
        $graphDatas = array();
        $employee = array();
        foreach ($results as $result) {
            array_push($labels, "\"".$result['name_initial']."\"");
            array_push($graphDatas, $result['vote']);
            $employee += array($result['person_no'] => $result['name_initial']);
        }

        $labels = implode(",", $labels);
        $graphDatas = implode(",", $graphDatas);

        $this->set("labels", $labels);
        $this->set("graphData", $graphDatas);
        $this->set("employeeData", $employee);
    }

    /**
    *    グラフソートメソッド
    *    Ajaxで呼ばれる
    */
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
        //社員情報の新規登録/編集分岐
        $person_no = $this->request->data('person_no');
  		if($person_no != null) {  
            $clientsData = $this->Clients->find()->where(['person_no' => $person_no])->first();
            //表示する文言を追加
            $title = "社員情報編集";
            $msg = "社員情報を修正してください";
            //画像表示用
            $id = $clientsData['person_no'];
            $pass = "<img src=/img/".$id.".jpg>";
            $name = $clientsData['name_initial'];
        }
        else{   
            //表示する文言を追加
            $title = "社員情報登録";
            $msg = "社員情報を入力してください";
            $id = NULL;
            $pass = "";
            $name = NULL;
        }
        $this->set('id', $id);
        $this->set('name', $name);
  		$this->set('message', $msg);
        $this->set('title', $title);
        $this->set('pass', $pass);
        $this->set('ErrMessage', NULL);
        $this->set('entity', $this->Clients->newEntity());
    }

    public function addEmployeeRecord() {
    	if($this->request->is('post')) {
            //登録新規登録・変更処理
            try{
                $post = $this->Clients->newEntity($this->request->data);
                $this->Clients->save($post);
                $msg = NULL;
            }catch(\PDOException $e){
                $msg = 'DB登録できませんでした';
            }
            //画像保存処理
            $fileName = $post['UploadData']['tmp_name'];
            $imgName = $post['person_no'].".jpg";
            move_uploaded_file($fileName,'img/'.$imgName);

            if($msg != null){
                $this->set('ErrMessage', $msg);
                $this->set('id', $post['person_no']);
                $this->set('name', $post['name_initial']);
                $this->set('message', "社員情報を入力してください");
                $this->set('title', "社員情報登録");
                $this->set('pass', NULL);
                $this->set('entity', $this->Clients->newEntity());
                $this->render('regist');
            }else{
                return  $this->redirect(['action' => 'aggregate']);
            }
    	}
    }

    public function editEmployeeRecord() {
        if($this->request->is('post')) {
            //登録新規登録・変更処理
            try{
                $post = $this->Clients->newEntity($this->request->data);
                $this->Clients->save($post);
                $msg = NULL;
            }catch(\PDOException $e){
                $msg = '編集できませんでした';
            }
            $this->log($post);
            //画像保存処理
            $fileName = $post['UploadData']['tmp_name'];
            $imgName = $post['person_no'].".jpg";
            move_uploaded_file($fileName,'img/'.$imgName);

            if($msg != null){
               $this->set('ErrMessage', $msg);
                $this->set('id', $post['person_no']);
                $this->set('name', $post['name_initial']);
                $this->set('message', "社員情報を修正してください");
                $this->set('title', "社員情報編集");
                $this->set('pass', "<img src=/img/".$post['person_no'].".jpg>");
                $this->set('entity', $this->Clients->newEntity());
                $this->render('regist');
            }else{
                return  $this->redirect(['action' => 'aggregate']);
            }
        }
    }

    public function delEmployeeRecord() {
        if($this->request->is('post')) {
            //del_flg更新
            $post = $this->request->getData();
            $recode = $this->Clients->get($post['person_no']);
            $recode = $this->Clients->patchEntity($recode, $post); 
            $this->Clients->save($recode);        

            //ログイン画面に戻る
            return  $this->redirect(['action' => 'aggregate']);
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