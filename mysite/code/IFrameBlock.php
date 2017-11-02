<?php

class IFrameBlock extends Block{
    
    private static $db = array(
        'EmbeddedURL' => 'Varchar(225)',
        'Title' => 'Text',
        'Width' => 'Int',
        'Height' => 'Int'
    );

    public function getCMSFields() {
        $f = parent::getCMSFields();
		$f->addFieldToTab('Root.Main', new TextField('Title', 'Title'));
		$f->addFieldToTab('Root.Main', new TextField('Width', 'Width'));
		$f->addFieldToTab('Root.Main', new TextField('Height', 'Height'));
		$f->addFieldToTab('Root.Main', new TextField('EmbeddedURL', 'URL (include https://)'));
        return $f;

    }
}