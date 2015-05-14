<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;
use Cake\ORM\TableRegistry;
use Cake\Auth\BaseAuthorize;
use Cake\Network\Request;
use Cake\Auth\DefaultPasswordHasher;
/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 */
class UsersController extends AppController
{
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow('register');
    }
	
	public function register()
    {
    	//Get Categories
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('all');
		$this->set('categories',$categories);
		
		$this->set('title', 'Jobs Board | Registration');
		
        $user = $this->Users->newEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->data);
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));
                return $this->redirect(['action' => 'register']);
            }
            $this->Flash->error(__('Unable to add the user.'));
        }
        $this->set('user', $user);
    }
	
	public function login()
	{
		$this->set('title', 'Jobs Board | Login');
	    if ($this->request->is('post')) {
	        $user = $this->Auth->identify();
	        if ($user) {
	            $this->Auth->setUser($user);
	            return $this->redirect($this->Auth->redirectUrl());
	        } else {
	        	$this->Flash->error(__('Invalid username or password, try again'));
			}
	        
	    }
	}
	
	public function logout()
	{
	    return $this->redirect($this->Auth->logout());
	}
}