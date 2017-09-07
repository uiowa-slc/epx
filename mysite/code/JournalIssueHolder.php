<?php
class JournalIssueHolder extends Page {

	private static $db = array(

	);

	private static $has_one = array(

	);

	private static $allowed_children = array("JournalIssue");

	public function getCMSFields() {

		$fields = parent::getCMSFields();

		return $fields;
	}

}

class JournalIssueHolder_Controller extends Page_Controller {

	public function init() {
		parent::init();
	}

}
