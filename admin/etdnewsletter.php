<?php

defined('_JEXEC') or die;
JHtml::_('behavior.tabstate');

if (!JFactory::getUser()->authorise('core.manage', 'com_etdnewsletter')) {
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

$controller = JControllerLegacy::getInstance('etdnewsletter');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
