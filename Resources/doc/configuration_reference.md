CCDNUser ProfileBundle Configuration Reference.
===============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser ProfileBundle
#
ccdn_user_profile:                    # Required
    template:
        engine:                       twig
        pager_theme:                  CCDNUserProfileBundle:Common:Paginator/twitter_bootstrap.html.twig
    entity:                           # Required
        user:                         # Required
            class:                    Acme\YourUserBundle\Entity\User # Required
        profile:
            class:                    CCDNUser\ProfileBundle\Entity\Profile
    gateway:
        user:
            class:                    CCDNUser\ProfileBundle\Model\Gateway\UserGateway
        profile:
            class:                    CCDNUser\ProfileBundle\Model\Gateway\ProfileGateway
    model:
        user:
            class:                    CCDNUser\ProfileBundle\Model\Model\UserModel
        profile:
            class:                    CCDNUser\ProfileBundle\Model\Model\ProfileModel
    repository:
        user:
            class:                    CCDNUser\ProfileBundle\Model\Repository\UserRepository
        profile:
            class:                    CCDNUser\ProfileBundle\Model\Repository\ProfileRepository
    manager:
        user:
            class:                    CCDNUser\ProfileBundle\Model\Manager\UserManager
        profile:
            class:                    CCDNUser\ProfileBundle\Model\Manager\ProfileManager
    form:
        type:
            avatar:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\AvatarFormType
            personal:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\PersonalFormType
            info:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\InfoFormType
            contact:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\ContactFormType
            bio:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\BioFormType
            signature:
                class:                CCDNUser\ProfileBundle\Form\Type\User\Profile\SignatureFormType
        handler:
            avatar:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateAvatarFormHandler
            personal:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdatePersonalFormHandler
            info:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateInfoFormHandler
            contact:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateContactFormHandler
            bio:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateBioFormHandler
            signature:
                class:                CCDNUser\ProfileBundle\Form\Handler\User\Profile\UpdateSignatureFormHandler
    component:
        dashboard:
            integrator:
                class:                CCDNUser\ProfileBundle\Component\Dashboard\DashboardIntegrator
        crumb_factory:
            class:                    CCDNUser\ProfileBundle\Component\Crumbs\Factory\CrumbFactory
        crumb_builder:
            class:                    CCDNUser\ProfileBundle\Component\Crumbs\CrumbBuilder
        event_listener:
            flash:
                class:                CCDNUser\ProfileBundle\Component\Dispatcher\Listener\FlashListener
    seo:
        title_length:                 67
    member:
        list:
            layout_template:          CCDNUserProfileBundle::base.html.twig
            members_per_page:         50
            member_since_datetime_format:  d-m-Y - H:i
            requires_login:           false
    profile:
        fallback_avatar:              /bundles/ccdnuserprofile/img/avatar_anonymous.gif
        edit:
            personal:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
            info:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
            contact:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
            avatar:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
            bio:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
            signature:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                form_theme:           CCDNUserProfileBundle:Common:Form/fields.html.twig
        show:
            requires_login:           false
            overview:
                layout_template:      CCDNUserProfileBundle::base.html.twig
                member_since_datetime_format:  d-m-Y - H:i
                last_login_datetime_format:    d-m-Y - H:i
            bio:
                layout_template:      CCDNUserProfileBundle::base.html.twig
```

Replace Acme\YourUserBundle\Entity\User with the user class of your chosen user bundle.

- [Return back to the docs index](index.md).
