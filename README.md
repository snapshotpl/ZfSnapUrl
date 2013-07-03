ZfSnapUrl 0.1.0
=========
It's the shortest url view helper ever for *Zend Framework 2*! :-)

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
            'id' => $this->id,
            'slug' => $this->slug,
        );
    }
}
```

And just write in view to print user profile url:
```php
<?= $this->u($this->user) ?>
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
