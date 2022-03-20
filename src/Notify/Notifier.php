<?php
namespace Notification\Notify;

use Notification\Channel\Handler\HandleData;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

class Notifier
{
	private array $config;

	private ContainerInterface $container;

	public function __construct(array $config, ContainerInterface $container)
	{
		$this->config    = $config;
		$this->container = $container;
	}

	/**
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function notify(NotificationData $data): void
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