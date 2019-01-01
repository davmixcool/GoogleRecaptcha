<?php
namespace Davmixcool\Frontend;

class Script
{

	protected $site_key;

	protected $selector;

	protected $theme;

	public function __construct($options=[])
	{
		$this->site_key = isset($options['site_key'])? $options['site_key'] : null;
		$this->selector = isset($options['selector'])? $options['selector'] : 'google_recaptcha_selector';
		$this->theme = isset($options['theme'])? $options['theme'] : 'light';
	}

	public function render()
	{
		return '
			<script type="text/javascript">
		      var onloadGoogleRecaptchaCallback = function() {
		        grecaptcha.render("'.$this->selector.'", {
		          \'sitekey\' : "'.$this->site_key.'",
		          \'theme\' : "'.$this->theme.'"
		        });
		      };
		    </script>
		    <script src="https://www.google.com/recaptcha/api.js?onload=onloadGoogleRecaptchaCallback&render=explicit"
		        async defer>
		    </script>
		';
	}
}
