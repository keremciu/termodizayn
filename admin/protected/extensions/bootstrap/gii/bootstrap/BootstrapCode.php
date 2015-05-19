<?php
Yii::import('gii.generators.crud.CrudCode');

class BootstrapCode extends CrudCode
{
	public function generateActiveRow($modelClass, $column)
	{
		if ($column->type === 'boolean')
			return "\$form->checkBoxRow(\$model,'{$column->name}')";
		if (preg_match('/^(is_published|is_deleted)$/i',$column->name))
			return "\$form->toggleButtonRow(\$model, '$column->name')";
		else if (stripos($column->dbType,'text') !== false)
			return "\$form->textAreaRow(\$model,'{$column->name}',array('rows'=>2, 'cols'=>30, 'class'=>'span8'))";
		else
		{
			if (preg_match('/^(image|icon|upload)$/i',$column->name))
				$inputField='fileFieldRow';
			else if (preg_match('/^(password|pass|passwd|passcode)$/i',$column->name))
				$inputField='passwordFieldRow';
			else
				$inputField='textFieldRow';

			if ($column->type!=='string' || $column->size===null)
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5'))";
			else
				return "\$form->{$inputField}(\$model,'{$column->name}',array('class'=>'span5','maxlength'=>$column->size))";
		}
	}
}
