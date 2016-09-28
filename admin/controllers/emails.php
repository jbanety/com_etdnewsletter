<?php

defined('_JEXEC') or die;

class EtdNewsletterControllerEmails extends JControllerAdmin {

    /**
     * Proxy for getModel.
     *
     * @param   string $name   The name of the model.
     * @param   string $prefix The prefix for the PHP class name.
     * @param   array  $config Array of configuration parameters.
     *
     * @return  JModelLegacy
     *
     * @since   1.6
     */
    public function getModel($name = 'Email', $prefix = 'EtdNewsletterModel', $config = array('ignore_request' => true)) {

        return parent::getModel($name, $prefix, $config);
    }
}
