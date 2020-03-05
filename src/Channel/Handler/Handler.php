<?php
namespace Notification\Channel\Handler;

interface Handler
{
	/**
	 * @param HandleData $data
	 * @return void
	 */
	public function handle(HandleData $data);
}