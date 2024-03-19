# GridPlay ONE Account

```bash
composer require gridplay/gpaone
```

## Installation & Basic Usage

Please see the [Base Installation Guide](https://socialiteproviders.com/usage/), then follow the provider specific instructions below.

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
Event::listen(function (\SocialiteProviders\Manager\SocialiteWasCalled $event) {
    $event->extendSocialite('gpaone', GpaOneProvider::class);
});
```

### Usage

You should now be able to use the provider like you would regularly use Socialite (assuming you have the facade installed):

```php
return Socialite::driver('gpaone')->redirect();
```

### Returned User fields

- ``id``
- ``grid``
- ``name``
- ``uuid``
