# GridPlay ONE Account

## Installation & Basic Usage

To use first install with composer
```json
    "require": {
        "gridplay/gpaone": "^1.0",
    }
```
```sh
composer update
```
or do...
```sh
composer require gridplay/gpaone
```
### Add configuration to `config/services.php`

```php
'gpaone' => [    
  'client_id' => env('GPAONE_CLIENT_ID'),  
  'client_secret' => env('GPAONE_CLIENT_SECRET'),  
  'redirect' => env('GPAONE_REDIRECT_URI') 
],
```

### Add provider event listener

#### Laravel 10 and below
Configure the package's listener to listen for `SocialiteWasCalled` events.

Add the event to your `listen[]` array in `app/Providers/EventServiceProvider`. See the [Base Installation Guide](https://socialiteproviders.com/usage/) for detailed instructions.

```php
protected $listen = [
    \SocialiteProviders\Manager\SocialiteWasCalled::class => [
        // ... other providers
        \GPAONE\GPAOneExtendSocialite::class.'@handle',
    ],
];
```

#### Laravel 11+
In your Providers/AppServiceProvider.php put the following in the boot function
```php
use Illuminate\Support\Facades\Event;
use \GPAONE\Provider as GpaOneProvider;
    public function boot(): void
    {
        Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
            $event->extendSocialite('gpaone', GpaOneProvider::class);
        });
    }
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('gpaone')->redirect();
```
```php
$user = Socialite::driver('gpaone')->user();
$gpid = $user->id;
$grid = $user->grid;
// etc.
```
### Returned User fields

- ``id``
- ``grid``
- ``name``
- ``uuid``
- ``avatar``

avatar field is a full URL to the user's profile picture

## Facade Features!

### isPrem($uuid)
```php
$isprem = GPa::isPrem($uuid);
```
This lets you offer premium only stuff on your site for our GPPremium users

### isBanned($uuid)
```php
$isbanned = GPa::isBanned($uuid);
```
This lets you denie access to your site/services if the sl avatar is banned in the GridPlay system

Both functions returns a true/false boolean


Any issues and/or comments please reach out to VenKellie.Resident in SecondLife
