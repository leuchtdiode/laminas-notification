<?php
namespace Notification\Notify;

class NotificationData
{
	/**
	 * @var string[]
	 */
	private array $channels = [];

	private array $data;

	public static function create(): self
	{
		return new self();
	}

	/**
	 * @return string[]
	 */
	public function getChannels(): array
	{
		return $this->channels;
	}

	/**
	 * @param string[] $channels
	 */
	public function setChannels(array $channels): NotificationData
	{
		$this->channels = $channels;
		return $this;
	}

	public function getData(): array
	{
		return $this->data;
	}

	public function setData(array $data): NotificationData
	{
		$this->data = $data;
		return $this;
	}
}