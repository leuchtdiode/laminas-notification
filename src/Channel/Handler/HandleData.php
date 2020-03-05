<?php
namespace Notification\Channel\Handler;

class HandleData
{
	/**
	 * @var array
	 */
	private $options;

	/**
	 * @var string[]
	 */
	private $data;

	/**
	 * @return self
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * @return array
	 */
	public function getOptions(): array
	{
		return $this->options;
	}

	/**
	 * @param array $options
	 * @return HandleData
	 */
	public function setOptions(array $options): HandleData
	{
		$this->options = $options;
		return $this;
	}

	/**
	 * @return string[]
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * @param string[] $data
	 * @return HandleData
	 */
	public function setData(array $data): HandleData
	{
		$this->data = $data;
		return $this;
	}
}