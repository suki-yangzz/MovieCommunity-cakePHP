<?php
class CommentsController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('comments', $this->Comment->find('all'));
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function add($review_id = null) {
		if(!$review_id) {
			throw new NotFoundException(__('Invalid review.'));
		}
		$userid = $this->Auth->user('id');
		if($userid) {
			if($this->request->is('post', 'put')) {
				$this->request->data['Comment']['user_id'] = $userid;
				$this->request->data['Comment']['review_id'] = $review_id;
				$this->Comment->create();
				if($this->Comment->save($this->request->data)) {
					$this->Session->setFlash(__('Your comment has been saved.'));
					return $this->redirect(array('controller' => 'reviews', 'action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to add your comment.'));
			}			
		} else {
			$this->Session->setFlash(__('You must be logged in to add a comment.'));
			return $this->redirect(array('controller' => 'reviews', 'action' => 'index'));
		}

	}

	public function edit($id = null) {
		if(!$id)
			throw new NotFoundException(__('Invalid comment.'));

		$comment = $this->Comment->findById($id);
		if(!$comment)
			throw new NotFoundException(__('Invalid comment.'));

		$userid = $this->Auth->user('id');
		$review_id = $comment['Comment']['review_id'];
		if($comment['Comment']['user_id'] != $userid) {
			$this->Session->setFlash(__('You can not edit that comment.'));
			return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $review_id, $userid));
		}

		if($this->request->is(array('post', 'put'))) {
			$this->Comment->id = $id;
			if($this->Comment->save($this->request->data)) {
				$this->Session->setFlash(__('Your comment has been updated.'));
				return $this->redirect(array('controller' => 'reviews', 'action' => 'view', $review_id, $userid));
			}
			$this->Session->setFlash(__('Unable to update your comment.'));
		}

		if(!$this->request->data) {
			$this->request->data = $comment;
		}
	}


	public function delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if($this->Comment->delete($id)) {
			$this->Session->setFlash(__('The comment with id: %s has been deleted.', h($id)));
			return $this->redirect(array('controller' => 'reviews', 'action' => 'index'));
		}
	}

}
?>
