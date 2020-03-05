<?php
namespace Notification\Channel\Handler;

class Email implements Handler
{
	/**
	 * @param HandleData $data
	 */
	public function handle(HandleData $data)
	{
		$options = $data->getOptions();
		$content = $data->getData();

		mail(
			implode(',', $options['recipients']),
			$options['subject'],
			implode(PHP_EOL . PHP_EOL, $content)
		);
	}
}