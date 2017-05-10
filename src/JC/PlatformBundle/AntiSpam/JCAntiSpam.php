<?php

namespace JC\PlatformBundle\AntiSpam;


class JCAntiSpam
{

	public function isSpam($text)
	{
		return strlen($text) < 50;
	}
}