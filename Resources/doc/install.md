Installing CCDNUser ProfileBundle 1.x
=====================================

## Dependencies:

1. [PagerFantaBundle](http://github.com/whiteoctober/WhiteOctoberPagerfantaBundle).
2. [CCDNComponent CommonBundle](https://github.com/codeconsortium/CCDNComponentCommonBundle).
3. [CCDNComponent BBCodeBundle](https://github.com/codeconsortium/CCDNComponentBBCodeBundle).
4. [CCDNComponent CrumbTrailBundle](https://github.com/codeconsortium/CCDNComponentCrumbTrailBundle).
5. [CCDNComponent DashboardBundle](https://github.com/codeconsortium/CCDNComponentDashboardBundle).

## Installation:

Installation takes only 4 steps:

1. Download and install dependencies via Composer.
2. Register bundles with AppKernel.php.
3. Update your app/config/routing.yml.
4. Update your database schema.

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

NOTE: Please replace ``dev-master`` in the snippet above with the latest stable branch, for example ``2.0.*``.

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
		new CCDNUser\ProfileBundle\CCDNUserProfileBundle(),
		...
	);
}
```

### Step 3: Update your app/config/routing.yml.

In your app/config/routing.yml add:

``` yml
CCDNUserProfileBundle:
    resource: "@CCDNUserProfileBundle/Resources/config/routing.yml"
    prefix: /
```

You can change the route of the standalone route to any route you like, it is included for convenience.

### Step 4: Update your database schema.

Make sure to add the ProfileBundle to doctrines mapping configuration:

``` yml
# app/config/config.yml
# Doctrine Configuration
doctrine:
    orm:
        default_entity_manager: default
        auto_generate_proxy_classes: "%kernel.debug%"
        resolve_target_entities:
            Symfony\Component\Security\Core\User\UserInterface: FOS\UserBundle\Entity\User
        entity_managers:
            default:
                mappings:
                    FOSUserBundle: ~
                    CCDNUserProfileBundle:
                        mapping:              true
                        type:                 yml
                        dir:                  "Resources/config/doctrine"
                        alias:                ~
                        prefix:               CCDNUser\ProfileBundle\Entity
                        is_bundle:            true
```

ProfileBundle uses the ProfileProvider of the CommonBundle and overrides it, allowing all references of a username via the method profilePath() to point to a users profile.

You will need to add this to your app/config/ccdn/component-common.yml file in order for this to work. This step is also required for ProfileBundle to work.

``` yml
ccdn_component_common:
    service:
        provider:
            profile_provider:
                class: CCDNUser\ProfileBundle\Component\Provider\Profile\ProfileProvider
```

If you are not using CCDNUserUserBundle, you will need to create a child bundle in order to override the default one-to-one relation of profile to user entity
 (which by default profile bundles maps to CCDNUserUserBundle).

To create a child bundle, add this to your bundles main file (i.e; AcmeProfileBundle.php)

``` php
class AcmeProfileBundle extends Bundle
{

    public function getParent()
    {
		// This lets Symfony know AcmeProfileBundle inherits everything from CCDNUserProfileBundle.
        return 'CCDNUserProfileBundle';
    }
}
```

It is also recommended in order for the bundle to function correctly that you add the following to your user entity:

``` php
/**
 * Setup Profile before being persisted.
 *
 */
public function prePersistAddProfile()
{
	if (null == $this->profile) {
		$this->profile = new Profile();
		
		$this->profile->setUser($this);			
	}
}

/**
 * Get profile
 *
 * @return CCDNUser\ProfileBundle\Entity\Profile
 */
public function getProfile()
{
    if (null == $this->profile) {
        $this->profile = new Profile();
        $this->profile->setUser($this);
    }
		
    return $this->profile;
}
	
/**
 * Set profile
 *
 * @param CCDNUser\ProfileBundle\Entity\Profile $profile
 * @return User
 */
public function setProfile(Profile $profile = null)
{
    $this->profile = $profile;

    if (null == $this->profile) {
        $this->profile = new Profile();
        $this->profile->setUser($this);
    }
				
	return $this;
}
```

This will ensure that when a profile does not exist, one can be lazily created, and the manager will persist this later on if it does not have a valid id.

You should add the prePersistAddProfile to your User entities lifecycle callbacks.

#### Copy over the contents of ProfileBundle/Resources/config/doctrine/Profile.orm.yml to your child bundle and change the user entity you wish profile bundle to relate to.


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