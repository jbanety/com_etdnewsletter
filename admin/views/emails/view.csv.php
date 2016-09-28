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
     * Display the view.
     *
     * @param   string $tpl The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  mixed  A string if successful, otherwise an Error object.
     */
    public function display($tpl = null) {

        $app = JFactory::getApplication();

        $this->items = $this->get('Items');

        if (empty($this->items)) {
            $app->enqueueMessage("Il n'y a aucun enregistrement à exporter.", 'error');
            $app->redirect(JRoute::_('index.php?option=com_etdnewsletter&view=emails'));
        }

        $document = $app->getDocument();

        $document->setMimeEncoding('text/csv');

        $app->setHeader('Pragma', 'public');
        $app->setHeader('Expires', '0');
        $app->setHeader('Cache-Control', 'must-revalidate, post-check=0, pre-check=0');
        $app->setHeader('Cache-Control', 'public', false);
        $app->setHeader('Content-Description', 'Export Etd Newsletter');
        $app->setHeader('Content-Disposition', 'attachment; filename="etdnewsletter_' . date('dmY') . '.csv"');

        $item    = array_pop($this->items);
        $keys    = get_object_vars($item);
        $keys    = array_keys($keys);
        $items   = [];
        $items[] = $item;
        reset($items);

        if (!empty($this->csvFields)) {
            $temp = array();

            foreach ($this->csvFields as $f) {
                if (in_array($f, $keys)) {
                    $temp[] = $f;
                }
            }

            $keys = $temp;
        }

        // Entêtes
        $csv = array();

        foreach ($keys as $k) {
            $k = str_replace('"', '""', $k);
            $k = str_replace("\r", '\\r', $k);
            $k = str_replace("\n", '\\n', $k);
            $k = '"' . $k . '"';

            $csv[] = $k;
        }

        echo implode(",", $csv) . "\r\n";

        foreach ($items as $item) {
            $csv  = array();
            $item = (array)$item;

            foreach ($keys as $k) {
                if (!isset($item[$k])) {
                    $v = '';
                } else {
                    $v = $item[$k];
                }

                if (is_array($v)) {
                    $v = 'Array';
                } elseif (is_object($v)) {
                    $v = 'Object';
                }

                $v = str_replace('"', '""', $v);
                $v = str_replace("\r", '\\r', $v);
                $v = str_replace("\n", '\\n', $v);
                $v = '"' . $v . '"';

                $csv[] = $v;
            }

            echo implode(",", $csv) . "\r\n";
        }

        return false;
    }
}
