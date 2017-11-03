<?php

class EmbedBlock extends Block{
    
    private static $db = array(
        'EmbeddedURL' => 'Varchar(225)',
        'Title' => 'Text',
        'Width' => 'Int',
        'Height' => 'Int'
    );

    private static $defaults = array(
        'Width' => 1280,
        'Height' => 720

    );

    private static $singular_name = 'EmbedBlock';

    public function getCMSFields() {
        $f = parent::getCMSFields();
		$f->addFieldToTab('Root.Main', new TextField('Title', 'Title'));
		$f->addFieldToTab('Root.Main', new TextField('Width', 'Width'));
		$f->addFieldToTab('Root.Main', new TextField('Height', 'Height'));
		$f->addFieldToTab('Root.Main', new TextField('EmbeddedURL', 'URL (include https://)'));
        return $f;

    }
}