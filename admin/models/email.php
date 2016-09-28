<?php

defined('_JEXEC') or die;

class EtdNewsletterModelEmail extends JModelAdmin {

	/**
	 * Returns a Table object, always creating it
	 *
	 * @param   string $type   The table type to instantiate
	 * @param   string $prefix A prefix for the table class name. Optional.
	 * @param   array  $config Configuration array for model. Optional.
	 *
	 * @return  JTable  A database object
	 */
	public function getTable($type = 'Email', $prefix = 'EtdNewsletterTable', $config = array()) {

		return JTable::getInstance($type, $prefix, $config);
	}

	public function getForm($data = array(), $loadData = true) {

	}

}
