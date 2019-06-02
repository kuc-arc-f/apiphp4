<?php
App::uses('AppController', 'Controller');
/**
 * Todos Controller
 *
 * @property Todo $Todo
 * @property PaginatorComponent $Paginator
 */
class TodosController extends AppController {

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
		$this->Todo->recursive = 0;
		$this->set('todos', $this->Paginator->paginate());
	}
	//
	public function api_index() {
		//var_dump($this->request->query["search"] );
		//exit();
		$this->Todo->recursive = 0;
		$limit = 100;
		$this->Paginator->settings = array(
			'limit' => $limit ,
			'order'=> array('Todo.id'=>'desc')
		);
		$dats = $this->Paginator->paginate();
		$arr = array();
		foreach ($dats as $dat){
			$item = $dat["Todo"];
			$dt = date( "Y-m-d", strtotime( $dat["Todo"]["up_date"] ) ); 
			// $dt = date( "Y-m-d", strtotime( "2019-05-21 09:19:21" ) ); 
			$item["date_str"] = $dt;
			$arr[] = $item;
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
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid todo'));
		}
		$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
		$this->set('todo', $this->Todo->find('first', $options));
	}
	//
	public function api_view($id = null) {
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
		$dat = $this->Todo->find('first', $options);
		$dt = date( "Y-m-d", strtotime( $dat["Todo"]["up_date"] ) ); 
		$dat["Todo"]["date_str"] = $dt;
		$this->out_crosHead();		
		echo(json_encode($dat["Todo"]));
		exit();
	}	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Todo->create();
			if ($this->Todo->save($this->request->data)) {
				$this->Flash->success(__('The todo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The todo could not be saved. Please, try again.'));
			}
		}
	}
	//
	public function api_add() {
		if ($this->request->is('post')) {
			$this->Todo->create();
			$json ='';
			$now_date = date('Y-m-d H:i:s');
			$this->request->data["Todo"]["up_date"] = $now_date;
			if ($this->Todo->save($this->request->data)) {
//var_dump($this->request->data["Blog"]);
//exit();
				$json = json_encode(['title' => $this->request->data["Todo"] ]);
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
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid todo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Todo->save($this->request->data)) {
				$this->Flash->success(__('The todo has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The todo could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
			$this->request->data = $this->Todo->find('first', $options);
		}
	}
	//
	public function api_edit($id = null) {
		$json ='';
		if (!$this->Todo->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			$options = array('conditions' => array('Todo.' . $this->Todo->primaryKey => $id));
			$arr = array();
			$dat = $this->Todo->find('first', $options);
			$json = json_encode($dat["Todo"]);
		}
		$this->out_crosHead();
		echo( $json );
		exit();		
	}
	//
	public function api_update($id = null) {
		$json ='';
		if (!$this->Todo->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Todo->save($this->request->data)) {
					$json = json_encode(['title' => $this->request->data["Todo"] ]);
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
		if (!$this->Todo->exists($id)) {
			throw new NotFoundException(__('Invalid todo'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Todo->delete($id)) {
			$this->Flash->success(__('The todo has been deleted.'));
		} else {
			$this->Flash->error(__('The todo could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	//
	public function api_delete($id = null) {
		$json ='';
		if (!$this->Todo->exists($id)) {
			$arr = array( 'message' => 'Invalid task', 'ret' => 0 );
			$json = json_encode($arr);
		}else{
			if ($this->Todo->delete($id)) {
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
