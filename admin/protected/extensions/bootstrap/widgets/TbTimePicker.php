<?php
/**
 * TbTimePicker class file.
 * @since 1.0.3
 * @see http://jdewit.github.com/bootstrap-timepicker/
 */

/**
 * TbTimePicker widget.
 */
class TbTimePicker extends CInputWidget
{
	public $form;

	public $options = array();

	public $events = array();

	public $htmlOptions = array();

	public function run()
	{
		list($name, $id) = $this->resolveNameID();

		if ($this->hasModel())
		{
			if($this->form)
				echo $this->form->textField($this->model, $this->attribute, $this->htmlOptions);
			else
				echo CHtml::activeTextField($this->model, $this->attribute, $this->htmlOptions);
		} else
			echo CHtml::textField($name, $this->value, $this->htmlOptions);

		$this->registerClientScript($id);

	}

	/**
	 * Registers required javascript files
	 * @param $id
	 */
	public function registerClientScript($id)
	{
		Yii::app()->bootstrap->registerAssetCss('bootstrap-timepicker.css');
		Yii::app()->bootstrap->registerAssetJs('bootstrap.timepicker.js');

		$options = !empty($this->options) ? CJavaScript::encode($this->options) : '';

		ob_start();

		echo "jQuery('#{$id}').timepicker({$options})";
		foreach ($this->events as $event => $handler)
			echo ".on('{$event}', " . CJavaScript::encode($handler) . ")";

		Yii::app()->getClientScript()->registerScript(__CLASS__ . '#' . $id, ob_get_clean() . ';');
	}
}