<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\ORM\TableRegistry;
use App\Form\JobForm;



/**
 * Jobs Controller
 *
 * @property \App\Model\Table\JobsTable $Jobs
 */
class JobsController extends AppController
{
	public $name = 'Jobs';

    /**
     * Index method
     */
    public function index()
    {
    	//Set Title
		$this->set('title', 'Jobs Board | Home');
		
		//Set Category Query Options
    	$options = array(
			'order' => array('categories.name'=>'asc')
		);
		
		
		//Get Categories
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('all',$options);
		$this->set('categories',$categories);
		
    	//Set Query Options
    	$options = array(
			'order' => array('Jobs.created' => 'desc'),
			'limit' => 100
		);
    	
    	//Get Jobs info
		$getjobs = TableRegistry::get('Jobs');
		$jobs = $getjobs->find('all',$options)->contain(['Types']);
		$this->set('jobs',$jobs);
    }
	
	/**
     * Browse method
     */
    public function browse($category = null)
    {
    	//Set Title
		$this->set('title', 'Jobs Board | Browse');
		
    	//Init Conditions Array
    	$conditions = array();
    	
		//Check Keyword Filter (Search)
		if($this->request->is('post')){
			if(!empty($this->request->data('keywords'))){
				$conditions = array(
					'OR' => array(
						'jobs.title LIKE' => '%'.$this->request->data('keywords').'%',
						'jobs.description LIKE' => '%'.$this->request->data('keywords').'%',
					)
				);
				
			}
		}
		
		//Check City Filter
		if(!empty($this->request->data('city')) && $this->request->data('city') != 'Select City'){
			//Match City
			$conditions = array(
				'Jobs.city LIKE' => '%'. $this->request->data('city').'%'
			);
		}
		
		//Check Category Filter
		if(!empty($this->request->data('category')) && $this->request->data('category') != 'Select Category'){
			//Match City
			$conditions = array(
				'Jobs.category_id LIKE' => '%'. $this->request->data('category').'%'
			);
		}
		
		$this->set('conditions',$conditions);
    	
    	//Set Category Query Options
    	$options = array(
			'order' => array('categories.name'=>'asc')
		);
		
		
		//Get Categories
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('all',$options);
		
		//Getting Current Category 
		$currentCategory = $getCategories
		    ->find()
		    ->where(['id' => $category])
		    ->first();
			
		$this->set('currentCategory',$currentCategory);
		$this->set('categories',$categories);
		
    	if($category != null){
    		//Match Category
    		$conditions = array('jobs.category_id LIKE' => $category);
    	}
		
		//Set Query Options
		$options = array(
			'order' => array('jobs.created'=>'desc'),
			'conditions' => $conditions,
			'limit' => 20
		);
		
    	//Get Jobs info
		$getjobs = TableRegistry::get('Jobs');
		$jobs = $getjobs->find('all',$options)->contain(['Types'])->contain(['Categories']);
		$this->set('jobs',$jobs);
		
    	
	}

	/*
	 * View Method
	 * For detailed information about selected Job
	 */
	public function view($id)
	{
		//Set Category Query Options
    	$options = array(
			'order' => array('categories.name'=>'asc')
		);
		
		
		//Get Categories
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('all',$options);
		$this->set('categories',$categories);
		
		
		if(!$id){
			throw new NotFoundException(__('Invalid job listing'));
		}
		
		$getjobs = TableRegistry::get('Jobs');
		$job = $getjobs->get($id, [
								    'contain' => ['Categories','Types']
								]);
		
		if(!$job){
			throw new NotFoundException(__('Invalid job listing'));
		}
		
		//Setting variables
		$this->set('job', $job);
		
		//Set Title
		$this->set('title', "Jobsboard | ".$job->title);
	}
	
	
	/*
	 * Add Method
	 * Allows adding new Job
	 */
	public function add()
	{
		
		//Form Init
		$newJob = new JobForm();
		
		//Set Title
		$this->set('title', 'Add New Job');
		
		//Setting Variable for Form
		$this->set('job','Job');
		
		//Get Categories
		$options = array(
			'order' => array('Categories.name' => 'asc')
		);
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('list', $options);
		$this->set('categories',$categories);
		
		//Get Types
		$options = array(
			'order' => array('Types.name' => 'asc')
		);
		$getTypes = TableRegistry::get('Types');
		$types = $getTypes->find('list', $options);
		$this->set('types',$types);
		
		//Submiting Data
		if($this->request->is('post')){
			if($newJob->execute($this->request->data)){
				$this->Flash->success('Your Job Was Added');
			}else {
                $this->Flash->error('There was a problem submitting your form.');
            }
		}
	}
	
	/*
	 * Edit Method
	 * Allows Edititng Job Entry
	 */
	public function edit($id = null){
		
		//Get Categories
		$options = array(
			'order' => array('Categories.name' => 'asc')
		);
		$getCategories = TableRegistry::get('Categories');
		$categories = $getCategories->find('list', $options);
		$this->set('categories',$categories);
		
		//Get Types
		$options = array(
			'order' => array('Types.name' => 'asc')
		);
		$getTypes = TableRegistry::get('Types');
		$types = $getTypes->find('list', $options);
		$this->set('types',$types);
		
		$job = $this->Jobs->get($id);
	    if ($this->request->is(['post', 'put'])) {
	        $this->Jobs->patchEntity($job, $this->request->data);
	        if ($this->Jobs->save($job)) {
	            $this->Flash->success(__('Your job has been updated.'));
	            return $this->redirect(['action' => 'index']);
	        }
	        $this->Flash->error(__('Unable to update your job.'));
	    }
	
	    $this->set('job', $job);
	}

	/*
	 * Delete Method
	 * Allows Deleting Job Entry
	 */
	public function delete($id)
	{
	    $this->request->allowMethod(['post', 'delete']);
		
	    $job = $this->Jobs->get($id);
	    if ($this->Jobs->delete($job)) {
	        $this->Flash->success(__('Job '.$job->title.' has been deleted.'));
	        return $this->redirect(['action' => 'index']);
	    }
	}
	
}