<?php

use SilverStripe\ORM\DataExtension;

class CommentControllerExtension extends DataExtension {

	public function alterCommentForm($form){

		$fields = $form->Fields();
		$fields->removeByName('URL');
	}
}
