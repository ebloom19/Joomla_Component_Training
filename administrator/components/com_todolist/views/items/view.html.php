<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

class TodolistViewItems extends JViewLegacy {
    protected $items;

    protected $pagination;

    protected $state;

    public function display($tpl = null) {
        $this->state = $this->get('State');
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        if(count($errors = $this->get('Errors'))) {
            throw new Exception(implode("\n", $errors));
        }

        parent::display($tpl);
    }
}