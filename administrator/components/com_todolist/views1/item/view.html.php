<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class TodolistViewItem extends JViewLegacy {
    protected $state;

    protected $item;

    protected $form;

    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->item = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        if(count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        parent::display($tpl);
    }
}