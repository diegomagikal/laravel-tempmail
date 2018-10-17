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

### Blocked services (growing)

All the domains of the following providers are blocked:
* temp-mail.org
* tempm.com
* getinboxes.com
* getnada.com


## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
