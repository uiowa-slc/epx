<?php
class JournalArticle extends Page {
	private static $db = array(

		'FormattedTitle' => 'HTMLText',
		'Citation' => 'HTMLText',
		'ExpandedText' => 'HTMLText',
		'IsExcerpt' => 'Boolean',
		'JointAuthorNotes' => 'HTMLText',

	);

	private static $has_one = array(
		'Image' => 'Image',
		'PrintableArticle' => 'File',
		'ResponseTo' => 'JournalArticle',
		'FeaturedTag' => 'JournalArticleTag',
		'Category' => 'JournalArticleCategory',
	);
	private static $has_many = array(
		'Responses' => 'JournalArticle',
	);

	private static $plural_name = 'JournalArticles';

	private static $many_many = array(

		'Tags' => 'JournalArticleTag',
	);
	private static $listing_page_class = 'JournalIssue';
	private static $show_in_sitetree = false;
	private static $default_parent = "JournalIssueHolder";
	private static $can_be_root = false;

	public function getArticleHolder() {
		$holder = JournalArticleHolder::get()->First();

		if ($holder) {
			return $holder;
		}
	}

	public function getArticleTitle() {

		if ($this->FormattedTitle) {
			return $this->FormattedTitle;
		} else {
			return $this->dbObject('Title');
		}

	}

	public function getCMSFields() {
		$fields = parent::getCMSFields();

		//Main Content tab.
		$fields->removeByName('Content');
		$fields->removeByName('Metadata');
		$fields->addFieldToTab('Root.Main', new CheckboxField('IsExcerpt', 'This article is a stub (a short version or simply a link to the PDF).'));

		$titleField = new HTMLEditorField('FormattedTitle', 'Formatted Article Title (only fill out if the article title uses bold, italics, etc.)');
		$titleField->setRows(1);
		$fields->addFieldToTab('Root.Main', $titleField);

		//Tag and Featured tag fields - ArticleInfo tab
		$tagField = TagField::create('Tags', 'Tags:', JournalArticleTag::get(), $this->Tags())->setShouldLazyLoad(true);
		$catField = DropdownField::create(
			'CategoryID',
			'Category',
			JournalArticleCategory::get()->map('ID', 'Title')
		)->setEmptyString('(No Category)');

		$fields->addFieldToTab('Root.Main', new UploadField('Image', 'Image (1920x1080 or 1280x720)'));
		$fields->addFieldToTab('Root.ArticleInfo', $tagField);
		$fields->addFieldToTab('Root.ArticleInfo', $catField);


		//Citation field - ArticleInfo tab
		$fields->addFieldToTab('Root.ArticleInfo', HTMLEditorField::create('Citation', 'Citation')->setRows(1));

		//Article summary/expanded/downloadable text - Article Text tab

		$fields->addFieldToTab('Root.ArticleText', new UploadField('PrintableArticle', 'Downloadable/printable version of the article'));
		$fields->addFieldToTab('Root.ArticleText', HTMLEditorField::create('Content', 'Article body')->setRows(50));

		//Responses field - Responses tab
		$responseFieldConfig = GridFieldConfig_RelationEditor::create();
		$responseFieldConfig->removeComponentsByType($responseFieldConfig->getComponentByType('GridFieldAddNewButton'));
		$responseGridField = new GridField('Responses', 'Responses', $this->Responses(), $responseFieldConfig);

		$fields->addFieldToTab('Root.Responses', $responseGridField);

		// Return fields
		return $fields;
	}

}

class JournalArticle_Controller extends Page_Controller {

	public function init() {

		parent::init();
	}

}
