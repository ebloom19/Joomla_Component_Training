<?php
/**
 * To-do list entry point - administrator
 */

 echo 'Hello world.';

 $params = JComponentHelper::getParams('com_todolist');

 $message = $params->get('message', '');

 echo $message;