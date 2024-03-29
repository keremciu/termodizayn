<?php
/**
 *## TbToggleColumn class file
 *
 * @author: antonio ramirez <antonio@clevertech.biz>
 */

/**
 *## TbToggleColumn widget
 *
 * Renders a button to toggle values of a column
 *
 * Modified version of jToggle column of Nikola Trifunović <http://www.trifunovic.me/>
 *
 * @package booster.widgets.grids.columns
 */
class TbToggleColumn extends TbDataColumn {

	public $value;

	/**
	 * @var string the attribute name of the data model. Used for column sorting, filtering and to render the corresponding
	 * attribute value in each data cell. If {@link value} is specified it will be used to rendered the data cell instead of the attribute value.
	 * @see value
	 * @see sortable
	 */
	public $name;

	/**
	 * @var array the HTML options for the data cell tags.
	 */
	public $htmlOptions = array('class' => 'toggle-column');

	/**
	 * @var array the HTML options for the header cell tag.
	 */
	public $headerHtmlOptions = array('class' => 'toggle-column');

	/**
	 * @var array the HTML options for the footer cell tag.
	 */
	public $footerHtmlOptions = array('class' => 'toggle-column');

	/**
	 * @var string the label for the toggle button. Defaults to "Check".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $checkedButtonLabel;

	/**
	 * @var string the label for the toggle button. Defaults to "Uncheck".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $uncheckedButtonLabel;

	/**
	 * @var string the label for the NULL value toggle button. Defaults to "Not Set".
	 * Note that the label will not be HTML-encoded when rendering.
	 */
	public $emptyButtonLabel;

	/**
	 * @var string the glyph icon toggle button "checked" state.
	 * You may set this property to be false to render a text link instead.
	 */
	public $checkedIcon = 'done';

	/**
	 * @var string the glyph icon toggle button "unchecked" state.
	 * You may set this property to be false to render a text link instead.
	 */
	public $uncheckedIcon = 'cancel';

	/**
	 * @var string the glyph icon toggle button "empty" state (example for null value)
	 */
	public $emptyIcon = 'question-sign';

	/**
	 * @var boolean display button with text or only icon with label tooltip
	 */
	public $displayText = false;

	/**
	 * @var boolean whether the column is sortable. If so, the header cell will contain a link that may trigger the sorting.
	 * Defaults to true. Note that if {@link name} is not set, or if {@link name} is not allowed by {@link CSort},
	 * this property will be treated as false.
	 * @see name
	 */
	public $sortable = true;

	/**
	 * @var mixed the HTML code representing a filter input (eg a text field, a dropdown list)
	 * that is used for this data column. This property is effective only when
	 * {@link CGridView::filter} is set.
	 * If this property is not set, a text field will be generated as the filter input;
	 * If this property is an array, a dropdown list will be generated that uses this property value as
	 * the list options.
	 * If you don't want a filter for this data column, set this value to false.
	 * @since 1.1.1
	 */
	public $filter;

	/**
	 * @var string Name of the action to call and toggle values
	 * @see bootstrap.action.TbToggleAction for an easy way to use with your controller
	 */
	public $toggleAction = 'toggle';

	/**
	 * @var string a javascript function that will be invoked after the toggle ajax call.
	 *
	 * The function signature is <code>function(data)</code>
	 * <ul>
	 * <li><code>success</code> status of the ajax call, true if the ajax call was successful, false if the ajax call failed.
	 * <li><code>data</code> the data returned by the server in case of a successful call or XHR object in case of error.
	 * </ul>
	 * Note that if success is true it does not mean that the delete was successful, it only means that the ajax call was successful.
	 *
	 * Example:
	 * <pre>
	 *  array(
	 *     class'=>'TbToggleColumn',
	 *     'afterToggle'=>'function(success,data){ if (success) alert("Toggled successfuly"); }',
	 *  ),
	 * </pre>
	 */
	public $afterToggle;

	/**
	 * @var string suffix substituted to a name class of the tag <a>
	 */
	public $uniqueClassSuffix = '';

	/**
	 * @var array the configuration for toggle button.
	 */
	protected $button = array();

	/**
	 * Initializes the column.
	 * This method registers necessary client script for the button column.
	 */
	public function init()
	{
		$this->assertNameNotNull();

		$this->initButton();
		$this->registerClientScript();
	}

	/**
	 * Initializes the default buttons (toggle).
	 */
	protected function initButton()
	{
		if ($this->checkedButtonLabel === null)
			$this->checkedButtonLabel = Yii::t('zii', 'Uncheck');

		if ($this->uncheckedButtonLabel === null)
			$this->uncheckedButtonLabel = Yii::t('zii', 'Check');

		if ($this->emptyButtonLabel === null)
			$this->emptyButtonLabel = Yii::t('zii', 'Not set');

		$this->button = array(
			'url' => 'Yii::app()->controller->createUrl("' . $this->toggleAction . '",array("pk"=>$data->primaryKey,"attribute"=>"' . $this->name . '"))',
			'htmlOptions' => array('class' => $this->name . '_toggle' . $this->uniqueClassSuffix),
		);

		if (Yii::app()->request->enableCsrfValidation) {
			$csrfTokenName = Yii::app()->request->csrfTokenName;
			$csrfToken = Yii::app()->request->csrfToken;
			$csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
		} else {
			$csrf = '';
		}

		if ($this->afterToggle === null) {
			$this->afterToggle = 'function(){}';
		}

		$this->button['click'] = "js:
function() {
	var th=this;
	var afterToggle={$this->afterToggle};
	$.fn.yiiGridView.update('{$this->grid->id}', {
		type:'POST',
		url:$(this).attr('href'),{$csrf}
		success:function(data) {
			$.fn.yiiGridView.update('{$this->grid->id}');
			afterToggle(true, data);
		},
		error:function(XHR){
			afterToggle(false,XHR);
		}
	});
	return false;
}";
	}

	/**
	 * Registers the client scripts for the button column.
	 */
	protected function registerClientScript()
	{
		$js = array();

		$function = CJavaScript::encode($this->button['click']);
		unset($this->button['click']);
		$class = preg_replace('/\s+/', '.', $this->button['htmlOptions']['class']);
		$js[] = "$(document).on('click','#{$this->grid->id} a.{$class}',$function);";

		if ($js !== array()) {
			Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $this->id, implode("\n", $js));
		}
	}

	/**
	 * Renders the data cell content.
	 * This method renders the view, update and toggle buttons in the data cell.
	 *
	 * @param integer $row the row number (zero-based)
	 * @param mixed $data the data associated with the row
	 */
	protected function renderDataCellContent($row, $data)
	{
		$checked = $this->getCheckedState($row, $data);
		$label = $this->makeButtonLabel($checked);
		$icon = $this->makeButtonIcon($checked);
		$url = $this->makeButtonUrl($row, $data);

		if ($this->displayText)
			$this->renderButton($label, $icon, $url);
		else
			$this->renderLink($label, $icon, $url);
	}

	private function makeButtonLabel($value)
	{
		return $value === null ? $this->emptyButtonLabel : ($value ? $this->checkedButtonLabel : $this->uncheckedButtonLabel);
	}

	private function assertNameNotNull()
	{
		if ($this->name !== null)
			return;

		$msg = Yii::t(
			'zii',
			'"{attribute}" attribute cannot be empty.',
			array('{attribute}' => "name")
		);
		throw new CException($msg);
	}

	/**
	 * @param $checked
	 *
	 * @return string
	 */
	protected function makeButtonIcon($checked)
	{
		return $checked === null ? $this->emptyIcon : ($checked ? $this->checkedIcon : $this->uncheckedIcon);
	}

	/**
	 * @param string $iconClass
	 *
	 * @return bool
	 */
	protected function isNotGlyphiconsIcon($iconClass)
	{
		return strpos($iconClass, 'icon') === false and strpos($iconClass, 'fa') === false;
	}

	/**
	 * @param $label
	 * @param $icon
	 * @param $url
	 */
	protected function renderLink($label, $icon, $url)
	{
		$htmlOptions = $this->button['htmlOptions'];

		$htmlOptions['title'] = $label;
		if (!isset($htmlOptions['data-toggle']))
			$htmlOptions['data-toggle'] = 'tooltip';

		$iconHtmlTemplate = $this->isNotGlyphiconsIcon($icon)
			? '<span><svg class="td-icon td-icon-done"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-%s"></use></svg></span>'
			: '<i class="%s"></i>';

		$iconHtml = sprintf($iconHtmlTemplate, $icon);

		echo CHtml::link($iconHtml, $url, $htmlOptions);
	}

	/**
	 * @param $label
	 * @param $icon
	 * @param $url
	 *
	 * @throws CException
	 */
	protected function renderButton($label, $icon, $url)
	{
		$button = $this->button;
		$button['icon'] = $icon;
		$button['url'] = $url;
		$button['label'] = $label;
		$button['class'] = 'booster.widgets.TbButton';
		$widget = Yii::createComponent($button);
		$widget->init();
		$widget->run();
	}

	/**
	 * @param $row
	 * @param $data
	 *
	 * @return mixed|string
	 */
	protected function makeButtonUrl($row, $data)
	{
		return isset($this->button['url'])
			? $this->evaluateExpression($this->button['url'], array('data' => $data, 'row' => $row))
			: '#';
	}

	/**
	 * @param $row
	 * @param $data
	 *
	 * @return mixed
	 */
	protected function getCheckedState($row, $data)
	{
		return ($this->value === null)
			? CHtml::value($data, $this->name)
			: $this->evaluateExpression($this->value, array('data' => $data, 'row' => $row));
	}
}
