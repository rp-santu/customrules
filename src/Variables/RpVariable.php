<?php 

namespace rpqa99\rplibrary\Variables;

use Craft;
use rpqa99\rplibrary\RpLibrary;
use craft\helpers\ElementHelper;
use yii\db\Expression;

class RpVariable
{
	public function file_exists(?string $file): bool
	{
		if (!$file) {
			return false;
		}
		return file_exists($file);
	}

	public function filemtime(?string $file): int
	{
		if (!$this->file_exists($file)) {
			return 0;
		}
		return filemtime($file);
	}

	public function file_content(?string $file): string
	{
		if (!$this->file_exists($file)) {
			return '';
		}
		return file_get_contents($file);
	}

	public function registerGlobalJs($nameOrValues, $value = null)
	{
		RpLibrary::$plugin->jsGlobals->register($nameOrValues, $value);
	}
	
	public function getColumnNameWithSuffix($columnName)
    {
		$fieldHandle = Craft::$app->getFields()->getFieldByHandle($columnName);
		return ElementHelper::fieldColumnFromField($fieldHandle);
    }

	public function setFindInSetQuery($query, $column, $columnVal, $whereOprType="&")
	{
		return ($whereOprType =='&')? $query->andWhere(new Expression('FIND_IN_SET(:column, '.$column.')'))->addParams([':column' => $columnVal]) : $query->orWhere(new Expression('FIND_IN_SET(:column, '.$column.')'))->addParams([':column' => $columnVal]);		
	}
}
