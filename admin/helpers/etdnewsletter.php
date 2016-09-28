<?php

defined('_JEXEC') or die;

class EtdNewsletterHelper extends JHelperContent {

    /**
     * Configure the Linkbar.
     *
     * @param   string $vName The name of the active view.
     *
     * @return  void
     *
     * @since   1.6
     */
    public static function addSubmenu($vName) {

        JHtmlSidebar::addEntry(
            JText::_('COM_ETDNEWSLETTER_SUBMENU_EMAILS'),
            'index.php?option=com_etdnewsletter&view=emails',
            $vName == 'emails'
        );

    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @param   string   $component  The component name.
     * @param   string   $section    The access section name.
     * @param   integer  $id         The item ID.
     *
     * @return  JObject
     *
     * @since   3.2
     */
    public static function getActions($component = 'com_etdnewsletter', $section = '', $id = 0) {
        return parent::getActions($component, $section, $id);
    }
}
