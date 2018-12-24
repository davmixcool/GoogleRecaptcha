# Google Recaptcha.

A PHP package which supports both back-end and front-end of Google recaptcha v2.


## Requirements

- PHP 5.5 and above

## Steps:

* [Installation](#installation)
* [Usage](#usage)
* [Maintainers](#maintainers)
* [License](#license)


### Installation

**Composer**

Run the following command to include this package via Composer

```shell
composer require davmixcool/google-recaptcha
```


### Usage
Simple to use.

```php
use Davmixcool\GoogleRecaptcha;
	
	//include the recaptcha configurations globally
	$googleRecaptcha = new GoogleRecaptcha([
		'secret_key' => 'Your secret key',
		'site_key' => 'Your site key',
		'theme' => 'light'
	]);

	//Place the renderJs before the closing body tag.
	$googleRecaptcha->renderJs();

	//Place the renderCaptcha where you want to display the captcha.
	$googleRecaptcha->renderCaptcha();

	// Check if captcha was passed successfully 
	if ($googleRecaptcha->check()) {
	    // Perform success action

	} else {
	    // Throw an error if catcha was not solved successfully
	}
```

### Maintainers

This package is maintained by [David Oti](http://github.com/davmixcool) and you!


### License

This package is licensed under the [MIT license](https://github.com/davmixcool/GoogleRecaptcha/blob/master/LICENSE).
