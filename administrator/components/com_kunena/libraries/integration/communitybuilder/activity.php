<?php
/**
 * Kunena Component
 * @package Kunena.Framework
 * @subpackage Integration.CommunityBuilder
 *
 * @copyright (C) 2008 - 2011 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();

class KunenaActivityCommunityBuilder extends KunenaActivity {
	protected $integration = null;

	public function __construct() {
		$this->integration = KunenaIntegration::getInstance ( 'communitybuilder' );
		if (! $this->integration || ! $this->integration->isLoaded ())
			return;
		$this->priority = 50;
	}

	public function getUserPoints($userid) {
		$points = null;
		$params = array ('userid' => $userid, 'points' => &$points );
		$this->integration->trigger ( 'getUserPoints', $params );
		return $points;
	}

	public function onBeforePost($message) {
		$params = array ('actor' => $message->get ( 'userid' ), 'replyto' => 0, 'message' => $message );
		$this->integration->trigger ( 'onBeforePost', $params );
	}

	public function onBeforeReply($message) {
		$params = array ('actor' => $message->get ( 'userid' ), 'replyto' => $message->parent->userid, 'message' => $message );
		$this->integration->trigger ( 'onBeforeReply', $params );
	}

	public function onBeforeEdit($message) {
		$params = array ('actor' => $message->get ( 'modified_by' ), 'message' => $message );
		$this->integration->trigger ( 'onBeforeEdit', $params );
	}

	public function onAfterPost($message) {
		$params = array ('actor' => $message->get ( 'userid' ), 'replyto' => 0, 'message' => $message );
		$this->integration->trigger ( 'onAfterPost', $params );
	}

	public function onAfterReply($message) {
		$params = array ('actor' => $message->get ( 'userid' ), 'replyto' => $message->parent->userid, 'message' => $message );
		$this->integration->trigger ( 'onAfterReply', $params );
	}

	public function onAfterEdit($message) {
		$params = array ('actor' => $message->get ( 'modified_by' ), 'message' => $message );
		$this->integration->trigger ( 'onAfterEdit', $params );
	}

	public function onAfterDelete($message) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'message' => $message );
		$this->integration->trigger ( 'onAfterDelete', $params );
	}

	public function onAfterUndelete($message) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'message' => $message );
		$this->integration->trigger ( 'onAfterUndelete', $params );
	}

	public function onAfterThankyou($target, $actor, $message) {
		$params = array ('actor' => $actor, 'target' => $target, 'message' => $message );
		$this->integration->trigger ( 'onAfterThankyou', $params );
	}

	public function onAfterSubscribe($topic, $action) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'topic' => $topic, 'action' => $action );
		$this->integration->trigger ( 'onAfterSubscribe', $params );
	}

	public function onAfterFavorite($topic, $action) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'topic' => $topic, 'action' => $action );
		$this->integration->trigger ( 'onAfterFavorite', $params );
	}

	public function onAfterSticky($topic, $action) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'topic' => $topic, 'action' => $action );
		$this->integration->trigger ( 'onAfterSticky', $params );
	}

	public function onAfterLock($topic, $action) {
		$my = JFactory::getUser();
		$params = array ('actor' => $my->id, 'topic' => $topic, 'action' => $action );
		$this->integration->trigger ( 'onAfterLock', $params );
	}

	public function onAfterKarma($target, $actor, $delta) {
		$params = array ('actor' => $actor, 'target' => $target, 'delta' => $delta );
		$this->integration->trigger ( 'onAfterKarma', $params );
	}
}