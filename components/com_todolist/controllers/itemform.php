<?php
defined('_JEXEC') or die;

class TodolistControllerItemForm extends JControllerForm {
    public function edit($key = NULL, $urlVar = NULL) {
        $app = JFactory::getApplication();

        $editId = $app->input->getInt('id', 0);

        // Set the user id for the user to edit in the session
        $app->setUserState('com_todolist.edit.item.id', $editId);

        $this->setRedirect(JRoute::_('index.php?option=com_todolist&view=itemform&layout=edit', false));
    }

    public function save($key = NULL, $urlVar = NULL) {
        // Check for request forgeries
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        // Initialise variables
        $app = JFactory::getApplication();
        $model = $this->getModel('ItemForm', 'TodolistModel');

        // Get the user data
        $data = JFactory::getApplication()->input->get('jform', array(), 'array');

        //Get the form 
        $form = $model->getForm();

        if (!$form) {
            throw new Execption($model->getError(), 500);
        }

        // Validate the posted data
        $data = $model->validate($form, $data);

        if ($data === false) {
            // Get the validation messages
            $errors = $model->getErrors();

            // Push up to three validation messages
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                } else {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            $jform = $app->input->get('jform', array(), 'ARRAY');

            // Save the data in the session
            $app->setUserState('com_todolist.edit.item.data', $jform);

            // Redirect back to the edit screen
            $id = (int) $app->getUserState('com_todolist.edit.item.id');
            $this->setRedirect(JRoute::_('index.php?option=com_todolist&view=itemform&layout=edit&id=' . $id, false));
        }
    }
}