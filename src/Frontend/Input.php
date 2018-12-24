<?php
namespace Davmixcool\Frontend;

class Input
{	

	protected $selector;

	function __construct($options=array())
	{	
		$this->selector = isset($options['selector'])? $options['selector'] : 'google_recaptcha_selector';
	}

	public function render()
	{
		return '<div id="'.$this->selector.'"></div>';
	}
}


?>