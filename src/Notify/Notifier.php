<?php
namespace Notification\Notify;

use Notification\Channel\Handler\HandleData;
use Psr\Container\ContainerInterface;

class Notifier
{
	/**
	 * @var array
	 */
	private $config;

	/**
	 * @var ContainerInterface
	 */
	private $container;

	/**
	 * @param array $config
	 * @param ContainerInterface $container
	 */
	public function __construct(array $config, ContainerInterface $container)
	{
		$this->config    = $config;
		$this->container = $container;
	}

	/**
	 * @param NotificationData $data
	 */
	public function notify(NotificationData $data)
	{
		$channels = $this->config['notification']['channels'] ?? [];

		foreach ($data->getChannels() as $channelId)
		{
			$channel = $channels[$channelId];

			$handler = $this->container->get(
				$channel['handler']
			);

			$handler->handle(
				HandleData::create()
					->setOptions($channel['options'])
					->setData($data->getData())
			);
		}
	}
}