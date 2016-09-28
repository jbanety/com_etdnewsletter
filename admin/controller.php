<?php

defined('_JEXEC') or die;

/**
 * Component Controller
 *
 * @since  1.5
 */
class EtdNewsletterController extends JControllerLegacy {

	/**
	 * The default view.
	 *
	 * @var    string
	 * @since  1.6
	 */
	protected $default_view = 'emails';

	/**
	 * Method to display a view.
	 *
	 * @param   boolean  $cachable   If true, the view output will be cached
	 * @param   array    $urlparams  An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
	 *
	 * @return  ContactController  This object to support chaining.
	 *
	 * @since   1.5
	 */
	public function display($cachable = false, $urlparams = array())
	{
		JLoader::register('EtdNewsletterHelper', JPATH_ADMINISTRATOR . '/components/com_etdnewsletter/helpers/etdnewsletter.php');

		$view   = $this->input->get('view', 'emails');
		$layout = $this->input->get('layout', 'default');
		$id     = $this->input->getInt('id');

		// Check for edit form.
		if ($view == 'email' && $layout == 'edit' && !$this->checkEditId('com_etdnewsletter.edit.email', $id)) {
			// Somehow the person just went to the form - we don't allow that.
			$this->setError(JText::sprintf('JLIB_APPLICATION_ERROR_UNHELD_ID', $id));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option=com_etdnewsletter&view=emails', false));

			return false;
		}

		return parent::display();
	}
}
