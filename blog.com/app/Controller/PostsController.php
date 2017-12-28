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
App::uses('ChaptersController', 'AppController');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link https://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PostsController extends AppController {

/**
 * This controller does not use a model
 *
 * @var array
 */
	public $uses = array();

/**
 * Displays a view
 *
 * @return CakeResponse|null
 * @throws ForbiddenException When a directory traversal attempt.
 * @throws NotFoundException When the view file could not be found
 *   or MissingViewException in debug mode.
 */
    public $helpers = array('Html', 'Form','Paginator');
    public $components = array('Paginator');
    public $paginate = array();
    public $name = "Posts";//define Controller name
    public function index() {
        $data = $this->Post->find('all');
        $this->Paginator->settings = array(
            'limit' => 10,
            'order' => array('Post.id' => 'asc')
        );

        try {

            $data1 = $this->Paginator->paginate("Post");
            $this->set("data",$data1);
        } catch (NotFoundException $e) {
            //Do something here like redirecting to first or last page.
            //$this->request->params['paging'] will give you required info.
        }
        if($this->Session->check("session")){
            $username = $this->Session->read('session');
//            echo $username;
            $level = $this->Post->User->findByusername($username);
            $this->set("name", $level);
        }else
        {
//            $this->Session->delete('session');
//            $this->Flash->set('Session timeout');
//            $this->redirect('/');
        }
        $this->set('posts', $data);

    }

    public function view($id) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $chapters = $this->Post->Chapter->query("SELECT * FROM chapters WHERE post_id = $id;");
        $posts = $this->Post->findById($id);
        if (!$posts) {
            throw new NotFoundException(__('Invalid post'));
        }
        if($this->Session->check("session")){
            $username = $this->Session->read('session');
//            echo $username;
            $level = $this->Post->User->findByusername($username);
            $this->set("name", $level);
        }
        $this->set('chapters', $chapters);
        $this->set('posts', $posts);
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
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }

        if (!$this->request->data) {
            $this->request->data = $post;
        }
    }

    public function add() {
        if ($this->request->is('post')) {
            $this->Post->create();
//            echo 1;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to add your post.'));
        }
    }


    public function delete($id) {
//        if ($this->request->is('get')) {
//            throw new MethodNotAllowedException();
//        }

        if ($this->Post->delete($id) && $this->Post->Chapter->query("DELETE From chapters WHERE post_id = $id")) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }

        return $this->redirect(array('action' => 'index'));
    }

    public function isAuthorized($user) {
        // All registered users can add posts
        if ($this->action === 'add') {
            return true;
        }

        // The owner of a post can edit and delete it
        if (in_array($this->action, array('edit', 'delete'))) {
            $postId = (int) $this->request->params['pass'][0];
            if ($this->Post->isOwnedBy($postId, $user['id'])) {
                return true;
            }
        }

        return parent::isAuthorized($user);
    }
}
