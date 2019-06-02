<?php
App::uses('AppController', 'Controller');
/**
 * Repos Controller
 *
 * @property Repo $Repo
 * @property PaginatorComponent $Paginator
 */
class ReposController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Repo->recursive = 0;
		$this->set('repos', $this->Paginator->paginate());
	}
	//
	public function api_index() {
//var_dump($this->request->query["search"] );
//exit();
		$this->Repo->recursive = 0;
		$limit = 100;
		if(isset($this->request->query["search"])){
			$this->Paginator->settings = array( 
				'conditions' => array(
					"OR" => array(
						'Repo.name LIKE' => $this->request->query["search"] . '%',
						'Repo.content LIKE' => '%'. $this->request->query["search"] . '%'
					),
				),
				'limit' => $limit ,'order'=> array('Repo.id'=>'desc')
			);		
		}else{
			$this->Paginator->settings = array( 'limit' => $limit ,'order'=> array('Repo.id'=>'desc'));		
		}
		$dats = $this->Paginator->paginate();
		$arr = array();
		foreach ($dats as $dat){
			$arr[] = $dat["Repo"];
		}
//		var_dump($arr );
		$this->out_crosHead();
		echo(json_encode($arr ));
		exit();
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Repo->exists($id)) {
			throw new NotFoundException(__('Invalid repo'));
		}
		$options = array('conditions' => array('Repo.' . $this->Repo->primaryKey => $id));
		$this->set('repo', $this->Repo->find('first', $options));
	}
	//
	public function api_view($id = null) {
		if (!$this->Repo->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$options = array('conditions' => array('Repo.' . $this->Repo->primaryKey => $id));
		$dat = $this->Repo->find('first', $options);
		$this->out_crosHead();		
		echo(json_encode($dat["Repo"]));
		exit();
	}
	/**
	 * add method
	 *
	 * @return void
	 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Repo->create();
			if ($this->Repo->save($this->request->data)) {
				$this->Flash->success(__('The repo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The repo could not be saved. Please, try again.'));
			}
		}
	}
	//
	public function api_add() {
		if ($this->request->is('post')) {
			$this->Repo->create();
			$json ='';
			if ($this->Repo->save($this->request->data)) {
				$json = json_encode(['title' => $this->request->data["Repo"] ]);
			} else {
				$json = json_encode(['message' => 'The item could not be saved. Please, try again.' ]);
			}
			$this->out_crosHead();
			echo( $json );
			exit();
		}
	}	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Repo->exists($id)) {
			throw new NotFoundException(__('Invalid repo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Repo->save($this->request->data)) {
				$this->Flash->success(__('The repo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The repo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Repo.' . $this->Repo->primaryKey => $id));
			$this->request->data = $this->Repo->find('first', $options);
		}
	}
	//
	public function api_edit($id = null) {
		$json ='';
		if (!$this->Repo->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			$options = array('conditions' => array('Repo.' . $this->Repo->primaryKey => $id));
			$arr = array();
			$dat = $this->Repo->find('first', $options);
//			$arr[] = $dat["Repo"];
			$json = json_encode($dat["Repo"]);
		}
		$this->out_crosHead();
		echo( $json );
		exit();		
	}
	//
	public function api_update($id = null) {
		$json ='';
		if (!$this->Repo->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Repo->save($this->request->data)) {
					$json = json_encode(['title' => $this->request->data["Repo"] ]);
				} else {
					$json = json_encode(['message' => 'The task could not be saved. Please, try again.' ]);
				}
			}
		}
		$this->out_crosHead();
		echo( $json );
		exit();
	}		

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->Repo->exists($id)) {
			throw new NotFoundException(__('Invalid repo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Repo->delete($id)) {
			$this->Flash->success(__('The repo has been deleted.'));
		} else {
			$this->Flash->error(__('The repo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	//
	public function api_delete($id = null) {
		$json ='';
		if (!$this->Repo->exists($id)) {
			$arr = array( 'message' => 'Invalid task', 'ret' => 0 );
			$json = json_encode($arr);
		}else{
			if ($this->Repo->delete($id)) {
				$arr = array('message' => 'OK deleted.', 'ret' => 1 );
				$json = json_encode($arr);
			} else {
				$arr = array( 'message' => 'The task could not be deleted.', 'ret' => 0 );
				$json = json_encode($arr);
			}
		}
		$this->out_crosHead();
		echo( $json );
		exit();	
	}	


	
}
