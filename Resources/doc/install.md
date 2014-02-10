Installing CCDNUser ProfileBundle.
==================================

## Dependencies:

> Note you will need a User Bundle so that you can map the UserInterface to your own User entity. You can use whatecer User Bundle you prefer. FOSUserBundle is highly rated.

## Installation:

Installation takes only 4 steps:

1. Download and install dependencies via Composer.
2. Register bundles with AppKernel.php.
3. Update your app/config/routing.yml.
4. Update your app/config/config.yml.
5. Update your database schema.

### Step 1: Download and install dependencies via Composer.

Append the following to end of your applications composer.json file (found in the root of your Symfony2 installation):

``` js
// composer.json
{
    // ...
    "require": {
        // ...
        "codeconsortium/ccdn-user-profile-bundle": "dev-master"
    }
}
```

Then, you can install the new dependencies by running Composer's ``update``
command from the directory where your ``composer.json`` file is located:

``` bash
$ php composer.phar update
```

### Step 2: Register bundles with AppKernel.php.

Now, Composer will automatically download all required files, and install them
for you. All that is left to do is to update your ``AppKernel.php`` file, and
register the new bundle:

``` php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
        new CCDNUser\ProfileBundle\CCDNUserProfileBundle(),
        // ...
    );
}
```

Notice this include KNP Paginator, which is an important dependency.

### Step 3: Update your app/config/routing.yml.

In your app/config/routing.yml add:

``` yml
CCDNUserProfileBundle:
    resource: "@CCDNUserProfileBundle/Resources/config/routing.yml"
    prefix: /
```

### Step 4: Update your app/config/config.yml.

In your app/config/config.yml add:

``` yml
# app/config/config.yml
ccdn_user_profile:
    entity:
        user:
            class: Acme\YourUserBundle\Entity\User
```

Replace Acme\YourUserBundle\Entity\User with the user class of your chosen user bundle.

### Step 5: Update your user entity.

In order for the bundle to function correctly, you need to implement the `ProfileUserInterface`. This interface extends
the Symfony user interface.
Your user entity would then look like similar to the following:

``` php
namespace My\Bundle\Entity;

use CCDNUser\ProfileBundle\Entity\ProfileUserInterface;

class MyUser implements ProfileUserInterface
{
    /**
     *
     * @access protected
     * @var \CCDNUser\ProfileBundle\Entity\Profile $profile
     */
    protected $profile;

    /**
     *
     * @access protected
     * @var \DateTime $registeredDate
     */
    protected $registeredDate;

    public function __construct()
    {
        parent::__construct();

        // your own logic
        $this->registeredDate = new \Datetime('now');
    }

    public function setProfile(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Get registeredDate
     *
     * @return \Datetime
     */
    public function getRegisteredDate()
    {
        return $this->registeredDate;
    }

    /**
     * Set registeredDate
     *
     * @param  \Datetime $registeredDate
     */
    public function setRegisteredDate(\Datetime $registeredDate)
    {
        $this->registeredDate = $registeredDate;
    }

    // Symfony UserInterface required methods ...
}
```

### Step 6: Update your database schema.

Make sure to add the ProfileBundle to doctrines mapping configuration:

``` yml
# app/config/config.yml
# Doctrine Configuration
doctrine:
    orm:
        default_entity_manager: default
        auto_generate_proxy_classes: "%kernel.debug%"
        resolve_target_entities:
            CCDNUser\ProfileBundle\Entity\ProfileUserInterface: Acme\YourUserBundle\Entity\User
        entity_managers:
            default:
                mappings:
                    CCDNUserProfileBundle:
                        mapping:              true
                        type:                 yml
                        dir:                  "Resources/config/doctrine"
                        alias:                ~
                        prefix:               CCDNUser\ProfileBundle\Entity
                        is_bundle:            true
```

Replace Acme\YourUserBundle\Entity\User with the user class of your chosen user bundle.

From your projects root Symfony directory on the command line run:

``` bash
$ php app/console doctrine:schema:update --dump-sql
```

Take the SQL that is output and update your database manually.

**Warning:**

> Please take care when updating your database, check the output SQL before applying it.

### Translations

If you wish to use default texts provided in this bundle, you have to make sure you have translator enabled in your config.

``` yaml
# app/config/config.yml
framework:
    translator: ~
```

## Next Steps.

Installation should now be complete!

If you need further help/support, have suggestions or want to contribute please join the community at [Code Consortium](http://www.codeconsortium.com)

- [Return back to the docs index](index.md).
- [Configuration Reference](configuration_reference.md).
