<?php
namespace Notification\Channel\Handler;

class HandleData
{
	private array $options;

	/**
	 * @var string[]
	 */
	private array $data;

	public static function create(): self
	{
		return new self();
	}

	public function getOptions(): array
	{
		return $this->options;
	}

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
	 */
	public function setData(array $data): HandleData
	{
		$this->data = $data;
		return $this;
	}
}