<?php
namespace Notification\Notify;

class NotificationData
{
	/**
	 * @var string[]
	 */
	private $channels = [];

	/**
	 * @var array
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
	 * @return string[]
	 */
	public function getChannels(): array
	{
		return $this->channels;
	}

	/**
	 * @param string[] $channels
	 * @return NotificationData
	 */
	public function setChannels(array $channels): NotificationData
	{
		$this->channels = $channels;
		return $this;
	}

	/**
	 * @return array
	 */
	public function getData(): array
	{
		return $this->data;
	}

	/**
	 * @param array $data
	 * @return NotificationData
	 */
	public function setData(array $data): NotificationData
	{
		$this->data = $data;
		return $this;
	}
}