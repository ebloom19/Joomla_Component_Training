<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.controller');

class TodolistController extends JControllerLegacy {
    public function display($chachable =false, $urlparams = false) {
        $app = JFactory::getApplication();
        $view = $app->input->getCmd('view', 'items');
        $app->input->set('view', $view);

        parent::display($chachable, $urlparams);

        return $this;
    }
}