<?php
namespace Davmixcool\Frontend;

class Input
{
	protected $selector;

	public function __construct($options=[])
	{
		$this->selector = isset($options['selector'])? $options['selector'] : 'google_recaptcha_selector';
	}

	public function render()
	{
		return '<div id="'.$this->selector.'"></div>';
	}
}
