<?php
namespace Notification\FileContent;

use Notification\Notify\NotificationData;
use Notification\Notify\Notifier;

class Executor
{
	private Notifier $notifier;

	public function __construct(Notifier $notifier)
	{
		$this->notifier = $notifier;
	}

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

			$pathinfo = pathinfo($file);

			rename(
				$file,
				$pathinfo['dirname'] . DIRECTORY_SEPARATOR . date('Ymdhis') . '-' . $pathinfo['basename']
			);
		}
	}
}