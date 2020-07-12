<?php
class LtLanguagesController extends AppController {

	var $name = 'LtLanguages';
	var $helpers = array('Html', 'Form');

	function admin_index() {
		$this->LtLanguage->recursive = 0;
		$this->set('ltLanguages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid LtLanguage.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ltLanguage', $this->LtLanguage->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->LtLanguage->create();
			if ($this->LtLanguage->save($this->data)) {
				$this->Session->setFlash(__('The LtLanguage has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LtLanguage could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid LtLanguage', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->LtLanguage->save($this->data)) {
				$this->Session->setFlash(__('The LtLanguage has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The LtLanguage could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->LtLanguage->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for LtLanguage', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->LtLanguage->del($id)) {
			$this->Session->setFlash(__('LtLanguage deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}