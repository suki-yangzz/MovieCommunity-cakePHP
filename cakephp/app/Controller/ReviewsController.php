<?php
class ReviewsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('reviews', $this->Review->find('all'));
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function view($id = null, $currentuser = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid review.'));
		}
		$review = $this->Review->findById($id);
		if(!$review) {
			throw new NotFoundException(__('Invalid review.'));
		}
		$this->set('review', $review);
		$this->set('currentuser', $currentuser);
		
	}

	public function add() {
		$userid = $this->Auth->user('id');
		if($userid) {
			if($this->request->is('post')) {
				$this->request->data['Review']['user_id'] = $userid;
				$this->Review->create();
				if($this->Review->save($this->request->data)) {
					$this->Session->setFlash(__('Your review has been saved.'));
					return $this->redirect(array('action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add your review.'));
			}			
		} else {
			$this->Session->setFlash(__('You must be logged in to add a review.'));
			return $this->redirect(array('action' => 'index'));
		}

	}



	public function edit($id = null) {
		if(!$id)
			throw new NotFoundException(__('Invalid review.'));

		$review = $this->Review->findById($id);
		if(!$review)
			throw new NotFoundException(__('Invalid review.'));

		$userid = $this->Auth->user('id');
		if($review['Review']['user_id'] != $userid) {
			$this->Session->setFlash(__('You can not edit that review.'));
			return $this->redirect(array('action' => 'index'));
		}

		if($this->request->is(array('post', 'put'))) {
			$this->Review->id = $id;
			if($this->Review->save($this->request->data)) {
				$this->Session->setFlash(__('Your review has been updated.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to update your review.'));
		}

		if(!$this->request->data) {
			$this->request->data = $review;
		}
	}

	public function delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if($this->Review->delete($id)) {
			$this->Session->setFlash(__('The review with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>
