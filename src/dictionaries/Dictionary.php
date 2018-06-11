<?php

namespace DLP\dictionaries;

use DLP\components\exceptions\ItemDictionaryNotFound;
use DLP\components\Serializer;
use DLP\components\Singleton;

abstract class Dictionary implements \ArrayAccess
{
	use Singleton;

	abstract protected function dataFile();

	/**
	 * @return string
	 */
	abstract protected function itemClass();

	/**
	 * @return array
	 */
	public function firstLine()
	{
		/** @var DictionaryItem $className */
		$className = $this->itemClass();
		return $className::properties();
	}

	/**
	 * @return array
	 */
	abstract public function projections($words);

	/**
	 * @return array
	 */
	abstract public function projection($word);

	private $items = [];
	protected $itemsByHash = [];

	private function __construct()
	{
		$jsonText = file_get_contents($this->pathFile());

		$this->items = Serializer::getInstance()
			->deserialize(
				$jsonText,
				$this->itemClass() . '[]',
				'json'
			);

		foreach ($this->items as $index => $item) {
			$hash = $item->getHash();
			$this->itemsByHash[$item->$hash][] = $item;
		}
	}

	protected function init()
	{
	}

	public function save()
	{
		file_put_contents(
			$this->pathFile(),
			Serializer::getInstance()
				->serialize($this->items, 'json')
		);
	}

	public function create(array $properties)
	{
		/** @var DictionaryItem $item */
		$itemClassName = $this->itemClass();
		$item = new $itemClassName();

		foreach ($properties as $key => $value) {
			$item->$key = $value;
		}

		$item->validation();

		$this[$item->i] = $item;

		$this->save();

		return $item;
	}

	public function remove($index)
	{
		unset($this[$index]);

		$this->save();

		return true;
	}

	public function getItemProperties($index = false)
	{
		/** @var DictionaryItem $className */
		$className = $this->itemClass();
		$values = $className::properties();
		if (!$index) {
			unset($values[0]);
		}
		return $values;
	}

	public function writeLn()
	{
		$result = [];

		foreach ($this->items as $item) {
			$result[] = $item->asArray();
		}

		return $result;
	}

	protected function pathFile()
	{
		return __DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $this->dataFile();
	}

	/**
	 * @param $hash
	 * @return DictionaryItem
	 */
	public function getByHash($hash)
	{

		if (empty($this->itemsByHash[$hash])) {
			throw new ItemDictionaryNotFound('The word "' . $hash . '" is not found in dictionary');
		}

		return $this->itemsByHash[$hash];
	}

	/**
	 * @param mixed $offset
	 * @param DictionaryItem $value
	 */
	public function offsetSet($offset, $value)
	{
		$value->validation();

		if (is_null($offset)) {
			$this->items[] = $value;
		} else {
			$this->items[$offset] = $value;
		}
	}

	public function offsetExists($offset)
	{
		return isset($this->items[$offset]);
	}

	public function offsetUnset($offset)
	{
		unset($this->items[$offset]);
	}

	public function offsetGet($offset)
	{
		return isset($this->items[$offset]) ? $this->items[$offset] : null;
	}
}