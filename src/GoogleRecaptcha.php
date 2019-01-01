<?php
namespace Davmixcool;

use Davmixcool\Frontend\Input;
use Davmixcool\Frontend\Script;

class GoogleRecaptcha
{
	protected $secret_key;

	protected $verify_peer;

	protected $verify_peer_name;

	protected $options;

	protected $script;

	protected $input;

	public function __construct($options=[])
	{
		$this->secret_key = isset($options['secret_key'])? $options['secret_key'] : null;
		$this->verify_peer = isset($options['verify_peer'])? $options['verify_peer'] : false;
		$this->verify_peer_name = isset($options['verify_peer_name'])? $options['verify_peer_name'] : false;
		$this->options = $options;

		$this->script = new Script($this->options);

		$this->input = new Input($this->options);
	}

	protected function buildQuery($captcha=null)
	{
		return http_build_query(
	        [
	          'secret' => $this->secret_key, //secret KEy provided by google
	          'response' => $captcha,   // g-captcha-response string sent from client
	          'remoteip' => $_SERVER['REMOTE_ADDR']
			]
	      );
	}

	protected function buildOptions($captcha=null)
	{
		//Build post data to make request with fetch_file_contents
     	$data = $this->buildQuery($captcha);
     	//Build options for the post request
     	$options = ['http' =>
	        [
	          'method'  => 'POST',
	          'header'  => 'Content-type: application/x-www-form-urlencoded',
	          'content' => $data
			],
	        "ssl" => [
	        "verify_peer"=> $this->verify_peer,
	        "verify_peer_name"=> $this->verify_peer_name,
			],
		];

	    return $options;
	}

	protected function verifySite($context=null)
	{
		/* Send request to Googles siteVerify API */
	    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify", false, $context);
	    $response = json_decode($response, true);

		return $response["success"] === false;
	}

	public function check()
	{
		if (!empty( $_POST['g-recaptcha-response'])) {
			$captcha = $_POST['g-recaptcha-response'];

	      	//Build options for the post request
	      	$opts = $this->buildOptions($captcha);
		    //Create a stream this is required to make post request with fetch_file_contents
		    $context = stream_context_create($opts);

		    return $this->verifySite($context);
		}

		return false;
	}

	public function renderJs()
	{
		return $this->script->render();
	}

	public function renderCaptcha()
	{
		return $this->input->render();
	}

}
