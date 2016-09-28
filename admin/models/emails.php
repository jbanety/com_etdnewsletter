<?php

defined('_JEXEC') or die;

use Joomla\Utilities\ArrayHelper;

class EtdNewsletterModelEmails extends JModelList {

    public function __construct($config = array()) {

        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id',
                'a.id',
                'name',
                'created',
                'a.created',
                'email',
                'a.email'
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string $ordering  An optional ordering field.
     * @param   string $direction An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function populateState($ordering = 'a.created', $direction = 'desc') {

        $this->setState('filter.search', $this->getUserStateFromRequest($this->context . '.filter.search', 'filter_search', '', 'string'));

        // List state information.
        parent::populateState($ordering, $direction);

    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string $id A prefix for the store id.
     *
     * @return  string  A store id.
     *
     * @since   1.6
     */
    protected function getStoreId($id = '') {

        // Compile the store id.
        $id .= ':' . $this->getState('filter.search');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return  JDatabaseQuery
     *
     * @since   1.6
     */
    protected function getListQuery() {

        // Create a new query object.
        $db    = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select($this->getState('list.select', 'a.id, a.firstname, a.lastname, a.created, a.email'));
        $query->from($db->quoteName('#__etdnewsletter_emails', 'a'));

        // Filter by search in name.
        $search = $this->getState('filter.search');

        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int)substr($search, 3));
            } else {
                $search = $db->quote('%' . str_replace(' ', '%', $db->escape(trim($search), true) . '%'));
                $query->where('(' . $db->quoteName('a.firstname') . ' LIKE ' . $search . ' OR ' . $db->quoteName('a.lastname') . ' LIKE ' . $search . ' OR ' . $db->quoteName('a.email') . ' LIKE ' . $search . ')');
            }
        }

        // Add the list ordering clause.
        $orderCol  = $this->state->get('list.ordering', 'a.created');
        $orderDirn = $this->state->get('list.direction', 'desc');

        if ($orderCol == "name") {
            if ($orderDirn == "asc") {
                $orderCol = "a.firstname asc, a.lastname";
            } else {
                $orderCol = "a.firstname desc, a.lastname";
            }
        }

        $query->order($db->escape($orderCol . ' ' . $orderDirn));

        return $query;
    }
}
