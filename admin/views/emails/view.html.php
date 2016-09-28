<?php

defined('_JEXEC') or die;

class EtdNewsletterViewEmails extends JViewLegacy {

    /**
     * An array of items
     *
     * @var  array
     */
    protected $items;

    /**
     * The pagination object
     *
     * @var  JPagination
     */
    protected $pagination;

    /**
     * The model state
     *
     * @var  object
     */
    protected $state;

    /**
     * Form object for search filters
     *
     * @var  JForm
     */
    public $filterForm;

    /**
     * The active search filters
     *
     * @var  array
     */
    public $activeFilters;

    /**
     * The sidebar markup
     *
     * @var  string
     */
    protected $sidebar;
    
    protected $canDo;

    /**
     * Display the view.
     *
     * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null) {

        EtdNewsletterHelper::addSubmenu('emails');

        $this->items         = $this->get('Items');
        $this->pagination    = $this->get('Pagination');
        $this->state         = $this->get('State');
        $this->filterForm    = $this->get('FilterForm');
        $this->activeFilters = $this->get('ActiveFilters');
        $this->canDo         = EtdNewsletterHelper::getActions();

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode("\n", $errors));

            return false;
        }

        $this->addToolbar();
        $this->sidebar = JHtmlSidebar::render();

        return parent::display($tpl);
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolbar() {

        JToolbarHelper::title(JText::_('COM_ETDNEWSLETTER_MANAGER_EMAILS'), 'address contact');

        if ($this->canDo->get('core.delete')) {
            JToolbarHelper::deleteList('JGLOBAL_CONFIRM_DELETE', 'emails.delete', 'JTOOLBAR_DELETE');
        }

        if ($this->canDo->get('core.admin') || $this->canDo->get('core.options')) {
            JToolbarHelper::preferences('com_etdnewsletter');
        }

        JToolbarHelper::link(JRoute::_('index.php?option=com_etdnewsletter&view=emails&format=csv'), 'JTOOLBAR_EXPORT', 'download');

        JHtmlSidebar::setAction('index.php?option=com_etdnewsletter');
    }

    /**
     * Returns an array of fields the table can be sorted by
     *
     * @return  array  Array containing the field name to sort by as the key and display text as value
     *
     * @since   3.0
     */
    protected function getSortFields() {

        return array(
            'a.created' => JText::_('COM_ETDNEWSLETTER_FIELD_CREATED_LABEL'),
            'a.email'   => JText::_('COM_ETDNEWSLETTER_FIELD_EMAIL_LABEL'),
            'name'      => JText::_('COM_ETDNEWSLETTER_FIELD_NAME_LABEL'),
            'a.id'      => JText::_('JGRID_HEADING_ID')
        );
    }
}
