ZfSnapUrl [![Build Status](https://travis-ci.org/snapshotpl/ZfSnapUrl.png?branch=master)](https://travis-ci.org/snapshotpl/ZfSnapUrl)
=========
It's the shortest url view helper ever for *Zend Framework 2*! :-)

Version 1.1.0 Created by Witold Wasiczko

Usage
-----
For routing:

    user/profile/:id/:slug

Implements interface:
```php
class User implements \ZfSnapUrl\Routable {

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
                // You can use anonymus functions
                return array(
                    'route'  => 'user/supelongroutename/edit'
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
<?= $this->u($this->user) ?> - To link user profile (default defined in getRouteName())
<?= $this->u($this->user, 'profile') ?> - Alias to first call
<?= $this->u($this->user, 'edit') ?> - custom route
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
        "snapshotpl/zf-snap-url": "dev-master"
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
* **1.1.0** Support for multi routes
* **1.0.0** Stable version with unit test
