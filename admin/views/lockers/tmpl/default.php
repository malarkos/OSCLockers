<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_lockers
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
JHtml::_('formbehavior.chosen', 'select');
 
$listOrder     = $this->escape($this->filter_order);
$listDirn      = $this->escape($this->filter_order_Dir);
?>
<form action="index.php?option=com_lockers&view=lockers" method="post" id="adminForm" name="adminForm">
	<div class="row-fluid">
		<div class="span6">
			<?php echo JText::_('COM_LOCKERS_FILTER'); ?>
			<?php
				echo JLayoutHelper::render(
					'joomla.searchtools.default',
					array('view' => $this)
				);
			?>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
		<tr>
			<th width="1%"><?php echo JText::_('COM_LOCKERS_NUM'); ?></th>
			<th width="2%">
				<?php echo JHtml::_('grid.checkall'); ?>
			</th>
                        <th width="10%">
				<?php echo JText::_('COM_LOCKERS_MEMBERNUM') ;?>
			</th>
			<th width="10%">
				<?php echo JHtml::_('grid.sort', 'COM_LOCKERS_LOCKERNUM', 'LockerNumber', $listDirn, $listOrder); ?>
			</th>
                        <th width="10%">
				<?php echo JText::_('COM_LOCKERS_BILLEDANNUALLY') ;?>
			</th>
                        <th width="20%">
				<?php echo JText::_('COM_LOCKERS_COMMENT') ;?>
			</th>
                        <th width="10%">
				<?php echo JText::_('COM_LOCKERS_LASTYEAR') ;?>
			</th>
                        <th width="10%">
				<?php echo JText::_('COM_LOCKERS_YEARPAID') ;?>
			</th>
                        <th width="7%">
				<?php echo JHtml::_('grid.sort', 'COM_LOCKERS_CURRENTSUBSPAID', 'CurrentSubsPaid', $listDirn, $listOrder); ?>
			</th>
                        <th width="7%">
				<?php echo JText::_('COM_LOCKERS_LASTMODIFIED') ;?>
			

		</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="10">
					<?php echo $this->pagination->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php if (!empty($this->items)) : ?>
				<?php foreach ($this->items as $i => $row) :
					$link = JRoute::_('index.php?option=com_lockers&task=locker.edit&id=' . $row->id);
				?>
 
					<tr>
						<td><?php echo $this->pagination->getRowOffset($i); ?></td>
						<td>
							<?php echo JHtml::_('grid.id', $i, $row->id); ?>
						</td>
						<td>
                                                        <?php echo $row->membername; ?>
						</td>
						<td>
							<a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_LOCKERS_EDIT_LOCKER'); ?>">
								<?php echo $row->LockerNumber; ?>
							</a>
						</td>
                                                
                                                
                                                <td>
                                                        <?php echo $row->BilledAnnually; ?>
						</td>
                                                <td>
                                                        <?php echo $row->Comment; ?>
						</td>
                                                <td>
                                                        <?php echo $row->lastyear; ?>
						</td>
                                                <td>
                                                        <?php echo $row->yearpaid; ?>
						</td>
                                                <td>
                                                        <?php echo $row->CurrentSubsPaid; ?>
							
						</td>
                                                <td>
                                                        <?php echo $row->lastmodified; ?>
						</td>
						
					</tr>
				<?php endforeach; ?>
			<?php endif; ?>
		</tbody>
	</table>
        <input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
	<input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
	<?php echo JHtml::_('form.token'); ?>
</form>