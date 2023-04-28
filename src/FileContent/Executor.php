<?php
namespace Notification\FileContent;

use Notification\Notify\NotificationData;
use Notification\Notify\Notifier;
use Throwable;

class Executor
{
	private Notifier $notifier;

	public function __construct(Notifier $notifier)
	{
		$this->notifier = $notifier;
	}

	/**
	 * @throws Throwable
	 */
	public function execute(ExecuteData $data): void
	{
		foreach ($data->getFiles() as $fileData)
		{
			$file = $fileData['file'];

			if (!file_exists($file) || !($fileContent = file_get_contents($file)))
			{
				continue;
			}

			$this->notifier->notify(
				NotificationData::create()
					->setChannels($fileData['channels'])
					->setData(
						explode(PHP_EOL, $fileContent)
					)
			);

			$pathInfo = pathinfo($file);

			rename(
				$file,
				$pathInfo['dirname'] . DIRECTORY_SEPARATOR . date('Ymdhis') . '-' . $pathInfo['basename']
			);
		}
	}
}