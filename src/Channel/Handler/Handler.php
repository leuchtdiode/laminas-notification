<?php
namespace Notification\Channel\Handler;

interface Handler
{
	public function handle(HandleData $data): void;
}