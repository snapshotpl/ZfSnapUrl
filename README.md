ZfSnapUrl [![Build Status](https://travis-ci.org/snapshotpl/ZfSnapUrl.png?branch=master)](https://travis-ci.org/snapshotpl/ZfSnapUrl)
=========
It's the shortest url view helper ever for **Zend Framework 2**! :-)

Version 1.1.2 Created by Witold Wasiczko

Usage
-----
For routing:

    user/profile/:id/:slug

Implements interface:
```php
class User implements \ZfSnapUrl\Routable {

    /* CODE */

    public function getRouteName() {
        return 'user/profile';
    }

    public function getRouteParams() {
        return array(
            'id'   => $this->getId(),
            'slug' => $this->getSlug(),
        );
    }
}
```

Usage in view:
```php
<?= $this->u($this->user) ?>
```

Or you can define multi routes:
```php
class User implements \ZfSnapUrl\Routable {

    /* CODE */

    public function getRouteName() {
        return 'profile';
    }

    public function getRouteParams() {
        return array(
            'profile' => array(
                'route'  => 'user/profile'
                'params' => array(
                    'id'   => $this->getId(),
                    'slug' => $this->getSlug(),
                );
            ),
            'edit' => function () {
                // You can use closures
                return array(
                    'route'  => 'user/super-long-route-name/edit'
                    'params' => array(
                        'id'   => $this->getId(),
                    );
                ),
            },
        );
    }
}
```

And just write in view to print user profile url:
```php
To link user profile (default defined in getRouteName())
<?= $this->u($this->user) ?>
Alias for prev usage
<?= $this->u($this->user, 'profile') ?>
Custom route
<?= $this->u($this->user, 'edit') ?>
```

**Without ZfSnapUrl** you need to write **THIS** every single time (!):
```php
<?= $this->url('user/profile', array('id' => $this->user->getId(), 'slug' => $this->user->getSlug())) ?>
```

How to install?
---------------
Via [`composer`](https://getcomposer.org/)
```json
{
    "require": {
        "snapshotpl/zf-snap-url": "1.*"
    }
}
```

Tests
-----

```sh
composer install --dev
```

or

```sh
composer update
```

then

```sh
phpunit --configuration tests/
```

Changelog
---------
* **1.1.2** Fixes ZF version dependencies in composer.json, small README improvements
* **1.1.1** Travis CI
* **1.1.0** Support for multi routes
* **1.0.0** Stable version with unit test
