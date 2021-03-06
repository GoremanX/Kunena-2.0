<?php
/**
 * Kunena Component
 * @package Kunena
 *
 * @Copyright (C) 2008 - 2011 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

$i=0;
JHTML::_('behavior.calendar');
JHTML::_('behavior.formvalidation');
JHTML::_('behavior.tooltip');
?>
<div class="forumlist">
	<div class="inner">
		<span class="corners-top"><span></span></span>
			<ul class="topiclist">
				<li class="header">
					<dl class="icon">
						<dt><?php echo $this->banInfo->id ? JText::_('COM_KUNENA_BAN_EDIT') : JText::_('COM_KUNENA_BAN_NEW' ); ?></dt>
						<dd>&nbsp;</dd>
					</dl>
				</li>
			</ul>

								<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena') ?>" id="kform-ban" name="kformban" method="post">
									<input type="hidden" name="view" value="user" />
									<input type="hidden" name="task" value="ban" />
									<input type="hidden" name="userid" value="<?php echo intval($this->profile->userid); ?>" />
									<?php echo JHTML::_( 'form.token' ); ?>

									<ul class="kform kmoderate-user clearfix">
										<li class="kedit-user-information-row krow-<?php echo $this->row(true) ?>">
											<div class="kform-label">
												<label><?php echo JText::_('COM_KUNENA_BAN_USERNAME') ?></label>
											</div>
											<div class="kform-field"><?php echo $this->escape($this->profile->username) ?></div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label><?php echo JText::_('COM_KUNENA_BAN_USERID') ?></label>
											</div>
											<div class="kform-field"><?php echo $this->escape($this->profile->userid) ?></div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="block"><?php echo JText::_('COM_KUNENA_BAN_BANLEVEL') ?></label>
											</div>
											<div class="kform-field">
												<?php
												// make the select list for the view type
												$block[] = JHTML::_('select.option', 0, JText::_('COM_KUNENA_BAN_BANLEVEL_KUNENA'));
												$block[] = JHTML::_('select.option', 1, JText::_('COM_KUNENA_BAN_BANLEVEL_JOOMLA'));
												// build the html select list
												echo JHTML::_('select.genericlist', $block, 'block', 'class="inputbox hasTip" size="1" title="'.JText::_('COM_KUNENA_BAN_BANLEVEL').' :: Select Ban From"', 'value', 'text', $this->escape($this->baninfo->blocked));
												?>
											</div>
										</li>
										<!-- li class="kedit-user-information-row krow-<?php //$this->row() ?>">
											<div class="kform-label"><label for="expiration">Coventry</label></div>
											<div class="kform-field"><input type="checkbox" class="hasTip" value="1" name="coventry" id="coventry" title="Coventry:: " /></div>
										</li -->
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="expiration"><?php echo JText::_('COM_KUNENA_BAN_EXPIRETIME') ?></label>
											</div>
											<div class="kform-field">
												<span class="hasTip" title="<?php echo JText::_('COM_KUNENA_BAN_EXPIRETIME') ?>::<?php echo JText::_('COM_KUNENA_BAN_STARTEXPIRETIME_DESC_LONG') ?>">
													<?php echo JHTML::_('calendar', $this->escape($this->baninfo->expiration), 'expiration', 'expiration', '%Y-%m-%d',array('onclick'=>'$(\'expiration\').setStyle(\'display\')')); ?>
												</span>
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="reason_public">
													<?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON') ?>
													<br/>
													<span class="ks"><?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON_DESC') ?></span>
												</label>
											</div>
											<div class="kform-field">
												<textarea id="reason_public" name="reason_public" class="ktxtarea required hasTip" title="<?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON') ?> :: <?php echo JText::_('COM_KUNENA_BAN_PUBLICREASON_DESC') ?>"></textarea>
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="reason_private">
													<?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON') ?>
													<br />
													<span class="ks"><?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON_DESC') ?></span>
												</label>
											</div>
											<div class="kform-field">
												<textarea id="reason_private" name="reason_private" class="ktxtarea required hasTip" title="<?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON') ?> :: <?php echo JText::_('COM_KUNENA_BAN_PRIVATEREASON_DESC') ?>"><?php echo $this->escape($this->baninfo->reason_public) ?></textarea>

											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="comment">
													<?php echo JText::_('COM_KUNENA_BAN_ADDCOMMENT') ?>
													<br />
													<span class="ks"><?php echo JText::_('COM_KUNENA_BAN_ADDCOMMENT_DESC') ?></span>
												</label>
											</div>
											<div class="kform-field">
												<textarea id="comment" name="comment" class="ktxtarea required hasTip" title="<?php echo JText::_('COM_KUNENA_BAN_ADDCOMMENT') ?> :: <?php echo JText::_('COM_KUNENA_BAN_ADDCOMMENT_DESC') ?>"><?php echo $this->escape($this->baninfo->reason_private) ?></textarea>
											</div>
										</li>
										<?php if($this->banInfo->id): ?>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="ban-delban"><?php echo JText::_('COM_KUNENA_MODERATE_REMOVE_BAN') ?></label>
											</div>
											<div class="kform-field">
												<input type="checkbox" class="hasTip" value="delban" name="delban" id="ban-delban" title="<?php echo JText::_('COM_KUNENA_MODERATE_REMOVE_BAN') ?> :: <?php echo JText::_('COM_KUNENA_MODERATE_REMOVE_BAN_DESC') ?>" />
											</div>
										</li>
										<?php endif; ?>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="ban-delsignature"><?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_SIGNATURE') ?></label>
											</div>
											<div class="kform-field">
												<input type="checkbox" class="hasTip" value="delsignature" name="delsignature" id="ban-delsignature" title="<?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_SIGNATURE') ?> :: <?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_SIGNATURE_DESC') ?>" />
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="ban-delavatar"><?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_AVATAR') ?></label>
											</div>
											<div class="kform-field">
												<input type="checkbox" class="hasTip" value="delavatar" name="delavatar" id="ban-delavatar" title="<?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_AVATAR') ?> :: <?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_AVATAR_DESC') ?>" />
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="ban-delprofileinfo"><?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_PROFILEINFO') ?></label>
											</div>
											<div class="kform-field">
												<input type="checkbox" class="hasTip" value="delprofileinfo" name="delprofileinfo" id="ban-delprofileinfo" title="<?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_PROFILEINFO') ?> :: <?php echo JText::_('COM_KUNENA_MODERATE_DELETE_BAD_PROFILEINFO_DESC') ?>" />
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-label">
												<label for="ban-delposts"><?php echo JText::_('COM_KUNENA_MODERATE_DELETE_ALL_POSTS') ?></label>
											</div>
											<div class="kform-field">
												<input type="checkbox" class="hasTip" value="bandelposts" name="bandelposts" id="ban-delposts" title="<?php echo JText::_('COM_KUNENA_MODERATE_DELETE_ALL_POSTS') ?> :: <?php echo JText::_('COM_KUNENA_MODERATE_DELETE_ALL_POSTS_DESC') ?>" />
											</div>
										</li>
										<li class="kedit-user-information-row krow-<?php echo $this->row() ?>">
											<div class="kform-field">
												<input class="tk-submit-button ks" type="submit" value="<?php echo $this->banInfo->id ? JText::_('COM_KUNENA_BAN_EDIT') : JText::_('COM_KUNENA_BAN_NEW' ) ?>" name="Submit" />
											</div>
										</li>
									</ul>
								</form>

		<span class="corners-bottom"><span></span></span>
	</div>
</div>