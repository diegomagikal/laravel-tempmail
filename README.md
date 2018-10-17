# laravel-tempmail

#### Validator to block temp mails usage.

### Introduction
This package verify if the typed email use a domain from any temporary email services and denies it.

### Installation

To get the latest version of this package, add the following line to your composer.json:

```
"diegomagikal/laravel-tempmail": "*"
```

### Usage

Use the rule `tempmail` in email validation, like this:


```php
/**
 * Get a validator.
 *
 * @param  array  $data
 * @return \Illuminate\Contracts\Validation\Validator
 */
protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users|tempmail',
        'password' => 'required|min:6|checkpassword|confirmed',
    ]);
}
```
![tempmail](https://user-images.githubusercontent.com/16082344/47108547-587b5980-d222-11e8-8c67-25144f20cf86.JPG)


### Custom message / translation
Add 'tempmail' key to resources/lang/{YOUR_LANG}/validation.php with the desired message.

```php
 	/*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */


    'tempmail' => 'Este tipo de e-email não é aceito. Digite seu email real!',
```
![tempmail-pt](https://user-images.githubusercontent.com/16082344/47112320-63d38280-d22c-11e8-8bd1-7b6e859335a3.JPG)



### Blocked services (growing)

All the domains of the following providers are blocked:
* temp-mail.org
* tempm.com
* getinboxes.com
* getnada.com


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
