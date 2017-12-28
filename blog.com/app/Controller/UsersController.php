<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
//	public $uses = array();

    var $helpers = array("Html", "Form", "Flash");
    var $component = array("Session");
/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
	public function login() {
        $error="";
        if(isset($_POST['ok'])){
            $username = $_POST['username'];
            $password = $_POST['password'];
//            echo $this->Auth->user('name');die();

            if($this->User->checkLogin($username,$password)){
//                $this->set("name",$level);
//                $this->set("users",$data);
                $this->Session->write('session',$username);//ghi session
                $this->redirect('info');//đăng nhập thành công chuyển trang thông tin
            }else{
                $error = "Tên đăng nhập và mật khẩu không đúng";
            }
        }

        if(isset($_POST['register'])){
            $this->register();
        }
        $this->set("error",$error);
	}

	public function home(){
	    $this->render('home');
    }

    function info(){
        if($this->Session->check("session")){//kiểm tra có session hay không
            $username = $this->Session->read('session');
            $level = $this ->User->findByusername($username);
            $this->set("name", $level);
        }else{
            $this->render("login");
        }
        $data = $this->User->find('all');
        $this->set("users",$data);
    }
    function logout(){
        $this->Session->delete('session'); //xóa session
//        $this->redirect("login"); //chuyển trang login
        return $this->redirect($this->Auth->logout());
    }

    public function register() {
        if ($this->request->is('post')) {
            $name = $_POST['data']['User']['username'];
            if(!($this->User->findByusername($name))) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Your post has been saved.'));
                    return $this->redirect(array('action' => 'register'));
                }
            }
            $this->Flash->error(__('Unable to add your post.'));
            return $this->redirect(array('action' => 'register'));
        }
    }

    public function delete($id) {
//        $this->Auth->user('id');
//        $level = $this ->User->findByid($value);
        echo $this->User->id;
        if($id != $this->User->id){
            $this->User->delete($id);
        }
//        $this->set('name',$level);
//        $level = $this ->User->findByusername($username);
        return $this->redirect(array('action' => 'info'));

    }

    public function add(){
        if ($this->request->is('post')) {
            $name = $_POST['data']['User']['username'];
            if (!($this->User->findByusername($name))) {
                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Flash->success(__('Your post has been saved.'));
                    return $this->redirect(array('action' => 'add'));
//                    return $this->render('add');
                }
            }
            $this->Flash->error(__('Unable to add your post.'));
            return $this->redirect(array('action' => 'add'));
//            return $this->render('add');
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
//                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
//            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }
}
