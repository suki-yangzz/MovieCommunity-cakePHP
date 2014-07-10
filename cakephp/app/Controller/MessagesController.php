<?php
class MessagesController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('messages', $this->Message->find('all'));
		$this->set('userid', $this->Auth->user('id'));
		$this->set('username', $this->Auth->user('username'));
	}

	public function sendmsm($receiver_id = null) {
		if(!$receiver_id)
			throw new NotFoundException(__('Invalid receiver.'));
		
		$sender_id = $this->Auth->user('id');
		if($sender_id) {
			if($this->request->is(array('post', 'put'))) {
				$this->request->data['Message']['sender_id'] = $sender_id;
				$this->request->data['Message']['user_id'] = $receiver_id;
				$this->Message->create();
				if($this->Message->save($this->request->data)) {
					$this->Session->setFlash(__('Your message has been sent.'));
					return $this->redirect(array('controller'=>'reviews', 'action' => 'index'));
				}
				$this->Session->setFlash(__('Unable to send your message.'));
			}
		} else {
			$this->Session->setFlash(__('You must be logged in to send a message.'));
			return $this->redirect(array('controller'=>'reviews', 'action' => 'index'));
		}

	}

	public function view($id = null) {
		if(!$id) {
			throw new NotFoundException(__('Invalid message.'));
		}
		$message = $this->Message->findById($id);
		if(!$message) {
			throw new NotFoundException(__('Invalid message.'));
		}
		$this->set('message', $message);
		
	}

	public function delete($id = null) {
		if($this->request->is('get')) {
			throw new MethodNotAllowedException();
		}

		if($this->Message->delete($id)) {
			$this->Session->setFlash(__('The message with id: %s has been deleted.', h($id)));
			return $this->redirect(array('action' => 'index'));
		}
	}
}
?>
