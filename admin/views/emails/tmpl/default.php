<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_contact
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');

JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');

$user      = JFactory::getUser();
$userId    = $user->get('id');
$listOrder = $this->escape($this->state->get('list.ordering'));
$listDirn  = $this->escape($this->state->get('list.direction'));
$assoc     = JLanguageAssociations::isEnabled();

?>
<form action="<?php echo JRoute::_('index.php?option=com_etdnewsletter'); ?>" method="post" name="adminForm" id="adminForm">
    <?php if (!empty($this->sidebar)) : ?>
    <div id="j-sidebar-container" class="span2">
        <?php echo $this->sidebar; ?>
    </div>
    <div id="j-main-container" class="span10">
        <?php else : ?>
        <div id="j-main-container">
            <?php endif; ?>
            <?php echo JLayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>
            <div class="clearfix"></div>
            <?php if (empty($this->items)) : ?>
                <div class="alert alert-no-items">
                    <?php echo JText::_('JGLOBAL_NO_MATCHING_RESULTS'); ?>
                </div>
            <?php else : ?>
                <table class="table table-striped" id="contactList">
                    <thead>
                    <tr>
                        <th width="1%" class="nowrap center">
                            <?php echo JHtml::_('grid.checkall'); ?>
                        </th>
                        <th class="nowrap">
                            <?php echo JHtml::_('searchtools.sort', 'JGLOBAL_TITLE', 'name', $listDirn, $listOrder); ?>
                        </th>
                        <th class="nowrap">
                            <?php echo JHtml::_('searchtools.sort', 'COM_ETDNEWSLETTER_FIELD_EMAIL_LABEL', 'a.email', $listDirn, $listOrder); ?>
                        </th>
                        <th width="10%" class="nowrap hidden-phone">
                            <?php echo JHtml::_('searchtools.sort', 'JDATE', 'a.created', $listDirn, $listOrder); ?>
                        </th>
                        <th width="1%" class="nowrap hidden-phone">
                            <?php echo JHtml::_('searchtools.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                        </th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <td colspan="100">
                            <?php echo $this->pagination->getListFooter(); ?>
                        </td>
                    </tr>
                    </tfoot>
                    <tbody>
                    <?php
                    $n = count($this->items);
                    foreach ($this->items as $i => $item) :
                    ?>
                        <tr class="row<?php echo $i % 2; ?>">
                            <td class="center">
                                <?php echo JHtml::_('grid.id', $i, $item->id); ?>
                            </td>
                            <td class="nowrap has-context">
                                <?php if ($this->canDo->get('core.edit')) : ?>
                                    <a href="<?php echo JRoute::_('index.php?option=com_etdnewsletter&task=email.edit&id=' . (int)$item->id); ?>"><?php echo $this->escape($item->firstname); ?> <?php echo $this->escape($item->lastname); ?></a>
                                <?php else : ?>
                                    <?php echo $this->escape($item->firstname); ?> <?php echo $this->escape($item->lastname); ?>
                                <?php endif; ?>
                            </td>
                            <td class="nowrap">
                                <?php echo $this->escape($item->email); ?>
                            </td>
                            <td class="nowrap small hidden-phone">
                                <?php echo JHtml::_('date', $item->created, JText::_('DATE_FORMAT_LC4')); ?>
                            </td>
                            <td class="hidden-phone">
                                <?php echo $item->id; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            <input type="hidden" name="task" value="" />
            <input type="hidden" name="boxchecked" value="0" />
            <?php echo JHtml::_('form.token'); ?>
        </div>
</form>
