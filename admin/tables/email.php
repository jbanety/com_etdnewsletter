<?php

defined('_JEXEC') or die;

class EtdNewsletterTableEmail extends JTable {

	/**
	 * Constructor
	 *
	 * @param   JDatabaseDriver &$db Database connector object
	 */
	public function __construct(&$db) {

		parent::__construct('#__etdnewsletter_emails', 'id', $db);

	}

}
