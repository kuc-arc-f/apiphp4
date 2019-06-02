<?php
App::uses('AppController', 'Controller');
/**
 * Blogs Controller
 *
 * @property Blog $Blog
 * @property PaginatorComponent $Paginator
 */
class BlogsController extends AppController {

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
		$this->Blog->recursive = 0;
		$this->set('blogs', $this->Paginator->paginate());
	}
	//
	public function api_index() {
		//var_dump($this->request->query["search"] );
		//exit();
		$this->Blog->recursive = 0;
		$limit = 100;
		$this->Paginator->settings = array(
//			'fields' => array('Blog.id','Blog.title','Blog.content', "DATE_FORMAT(up_date,'%Y-%m-%d') as date_str" ),
			'limit' => $limit ,
			'order'=> array('Blog.id'=>'desc')
		);
		$dats = $this->Paginator->paginate();
		$arr = array();
		foreach ($dats as $dat){
			$item = $dat["Blog"];
			$dt = date( "Y-m-d", strtotime( $dat["Blog"]["up_date"] ) ); 
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$this->set('blog', $this->Blog->find('first', $options));
	}
	//
	public function api_view($id = null) {
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid id'));
		}
		$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
		$dat = $this->Blog->find('first', $options);
		$dt = date( "Y-m-d", strtotime( $dat["Blog"]["up_date"] ) ); 
		$dat["Blog"]["date_str"] = $dt;
		$this->out_crosHead();		
		echo(json_encode($dat["Blog"]));
		exit();
	}	

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			if ($this->Blog->save($this->request->data)) {
				$this->Flash->success(__('The blog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The blog could not be saved. Please, try again.'));
			}
		}
	}
	//
	public function api_add() {
		if ($this->request->is('post')) {
			$this->Blog->create();
			$json ='';
			$now_date = date('Y-m-d H:i:s');
			$this->request->data["Blog"]["up_date"] = $now_date;
			if ($this->Blog->save($this->request->data)) {
//var_dump($this->request->data["Blog"]);
//exit();
				$json = json_encode(['title' => $this->request->data["Blog"] ]);
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Blog->save($this->request->data)) {
				$this->Flash->success(__('The blog has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Flash->error(__('The blog could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$this->request->data = $this->Blog->find('first', $options);
		}
	}
	//
	public function api_edit($id = null) {
		$json ='';
		if (!$this->Blog->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			$options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
			$arr = array();
			$dat = $this->Blog->find('first', $options);
			$json = json_encode($dat["Blog"]);
		}
		$this->out_crosHead();
		echo( $json );
		exit();		
	}
	public function api_update($id = null) {
		$json ='';
		if (!$this->Blog->exists($id)) {
			$json = json_encode(['message' => 'Invalid task' ]);
		}else{
			if ($this->request->is(array('post', 'put'))) {
				if ($this->Blog->save($this->request->data)) {
					$json = json_encode(['title' => $this->request->data["Blog"] ]);
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
		if (!$this->Blog->exists($id)) {
			throw new NotFoundException(__('Invalid blog'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Blog->delete($id)) {
			$this->Flash->success(__('The blog has been deleted.'));
		} else {
			$this->Flash->error(__('The blog could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	//
	public function api_delete($id = null) {
		$json ='';
		if (!$this->Blog->exists($id)) {
			$arr = array( 'message' => 'Invalid task', 'ret' => 0 );
			$json = json_encode($arr);
		}else{
			if ($this->Blog->delete($id)) {
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
