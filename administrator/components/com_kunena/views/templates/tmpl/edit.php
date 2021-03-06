<?php
/**
 * Kunena Component
 * @package Kunena.Administrator.Template
 * @subpackage Templates
 *
 * @copyright (C) 2008 - 2011 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$document = JFactory::getDocument();
$document->addStyleSheet ( JURI::base(true).'/components/com_kunena/media/css/admin.css' );
if (JFactory::getLanguage()->isRTL()) $document->addStyleSheet ( JURI::base().'components/com_kunena/media/css/admin.rtl.css' );
JHTML::_('behavior.tooltip');
?>
<div id="kadmin">
	<div class="kadmin-left"><?php include KPATH_ADMIN.'/views/common/tmpl/menu.php'; ?></div>
	<div class="kadmin-right">
	<div class="kadmin-functitle icon-template"><?php echo JText::_('COM_KUNENA_A_TEMPLATE_MANAGER_EDIT_TEMPLATE'); ?> - <?php echo JText::_($this->details->name); ?></div>
		<div style="border: 1px solid #ccc; padding: 10px 0 0;">
		<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" method="post" name="adminForm">
		<input type="hidden" name="view" value="templates" />
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="templatename" value="<?php echo $this->escape($this->templatename); ?>">
		<?php echo JHTML::_( 'form.token' ); ?>

		<div class="col width-50">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'COM_KUNENA_A_TEMPLATE_MANAGER_DETAILS' ); ?></legend>
				<table class="admintable">
				<tr>
					<td colspan="2" class="key" style="text-align:left; padding: 10px 0 0 10px;"><h1><?php echo JText::_($this->details->name); ?></h1></td>
				</tr>
				<tr>
					<td valign="top" class="key"><?php echo JText::_( 'COM_KUNENA_A_TEMPLATE_MANAGER_AUTHOR' ); ?>:</td>
					<td><strong><?php echo JText::_($this->details->author); ?></strong></td>
				</tr>
				<tr>
					<td valign="top" class="key"><?php echo JText::_( 'COM_KUNENA_A_TEMPLATE_MANAGER_DESCRIPTION' ); ?>:</td>
					<td><?php $path = KPATH_SITE.'/template/'.$this->templatename. '/images/template_thumbnail.png';
						if (file_exists ( $path )) : ?>
						<div class="tpl-thumbnail"><img src ="<?php echo JURI::root (); ?>/components/com_kunena/template/<?php echo $this->escape($this->templatename); ?>/images/template_thumbnail.png" alt="" /></div>
						<?php endif; ?>
						<div class="tpl-desc"><?php echo JText::_($this->details->description); ?></div>
					</td>
				</tr>
				</table>
			</fieldset>
		</div>
		<div class="col width-50">
			<fieldset class="adminform">
				<legend><?php echo JText::_( 'COM_KUNENA_A_TEMPLATE_MANAGER_PARAMETERS' ); ?></legend>
				<table class="admintable">
				<tr>
					<td colspan="2" class="key" style="text-align:left; padding: 10px">
						<?php $templatefile = KPATH_SITE.'/template/'.$this->templatename.'/params.ini';
							echo is_writable($templatefile) ? JText::sprintf('COM_KUNENA_A_TEMPLATE_MANAGER_PARAMSWRITABLE', $this->escape($templatefile)):JText::sprintf('COM_KUNENA_A_TEMPLATE_MANAGER_PARAMSUNWRITABLE', $this->escape($templatefile));
						?>
					</td>
				</tr>
				<tr>
					<td>
						<?php
							if (!is_null($this->params)) {
								echo $this->params->render();
							} else {
								echo '<em>' . JText :: _('COM_KUNENA_A_TEMPLATE_MANAGER_NO_PARAMETERS') . '</em>'; }
						?>
					</td>
				</tr>
				</table>
			</fieldset>
		</div>
		<div class="clr"></div>
		</form>
		</div>
	</div>
	<div class="kadmin-footer">
		<?php echo KunenaVersion::getLongVersionHTML (); ?>
	</div>
</div>