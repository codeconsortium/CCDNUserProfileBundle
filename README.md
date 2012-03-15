CCDN User README.
==================


Notes:  
------
  
This bundle is for the symfony framework and thusly requires Symfony 2.0.x and PHP 5.3.6
  
This project uses Doctrine 2.0.x and so does not require any specific database.
  

This file is part of the CCDNUser bundles(s)

(c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/> 

Available on github <http://www.github.com/codeconsortium/>

For the full copyright and license information, please view the LICENSE
file that was distributed with this source code.


Dependencies:
-------------

1. [FOSUserBundle](http://github.com/FriendsOfSymfony/FOSUserBundle).
2. [EWZTimeBundle](http://github.com/excelwebzone/EWZRecaptchaBundle).
3. [PagerFanta](https://github.com/whiteoctober/Pagerfanta).
4. [PagerFantaBundle](http://github.com/whiteoctober/WhiteOctoberPagerfantaBundle).
5. [CCDNComponent CommonBundle](https://github.com/codeconsortium/CommonBundle).
6. [CCDNComponent BBCodeBundle](https://github.com/codeconsortium/BBCodeBundle).
7. [CCDNComponent CrumbTrailBundle](https://github.com/codeconsortium/CrumbTrailBundle).


Installation:
-------------

1) Download and install the dependencies.

   You can set deps to include:

```sh
[FOSUserBundle]
    git=http://github.com/FriendsOfSymfony/FOSUserBundle.git
    target=/bundles/FOS/UserBundle

[EWZTimeBundle]
    git=http://github.com/excelwebzone/EWZRecaptchaBundle.git
    target=/bundles/EWZ/Bundle/RecaptchaBundle

[pagerfanta]
    git=http://github.com/whiteoctober/Pagerfanta.git

[PagerfantaBundle]
    git=http://github.com/whiteoctober/WhiteOctoberPagerfantaBundle.git
    target=/bundles/WhiteOctober/PagerfantaBundle

[CommonBundle]
    git=http://github.com/codeconsortium/CommonBundle.git
    target=/bundles/CCDNComponent/CommonBundle

[BBCodeBundle]
    git=http://github.com/codeconsortium/BBCodeBundle.git
    target=/bundles/CCDNComponent/BBCodeBundle

[CrumbTrailBundle]
    git=http://github.com/codeconsortium/CrumbTrailBundle.git
    target=/bundles/CCDNComponent/CrumbTrailBundle
```
add to your autoload:

```php
    'CCDNComponent'    => __DIR__.'/../vendor/bundles',
    'CCDNUser'        => __DIR__.'/../vendor/bundles',
```

2) In your AppKernel.php add the following bundles to the registerBundles method array:  

```php
    new CCDNUser\MemberBundle\CCDNUserMemberBundle(),    
    new CCDNUser\ProfileBundle\CCDNUserProfileBundle(),    
    new CCDNUser\UserAdminBundle\CCDNUserUserAdminBundle(),    
    new CCDNUser\UserBundle\CCDNUserUserBundle(),    
``` 

3) In your app/config/config.yml add:    

```sh
fos_user:
   db_driver:      orm
   firewall_name:  main
   user_class:     CCDNUser\UserBundle\Entity\User
   use_listener:   true
#    from_email:     { webmaster@example.com: Admin }
   profile:
       form:
#            type:               FOS\UserBundle\Form\ProfileFormType
#            handler:            FOS\UserBundle\Form\ProfileFormHandler
           name:               fos_user_profile_form
           validation_groups:  [Profile]
   change_password:
       form:
#            type:               FOS\UserBundle\Form\ChangePasswordFormType
#            handler:            FOS\UserBundle\Form\ChangePasswordFormHandler
#            name:               fos_user_change_password_form
#            validation_groups:  [ChangePassword]
   registration:
#        confirmation:
#            from_email: ~
#            enabled:    false
#            template:   FOSUserBundle:Registration:email.txt.twig
        form:
            type:               ccdn_user_registration
#            handler:            FOS\UserBundle\Form\RegistrationFormHandler
#            name:               fos_user_registration_form
#            validation_groups:  [Registration]
   resetting:
       token_ttl: 86400
#        email:
#            from_email: ~
#            template:   FOSUserBundle:Resetting:email.txt.twig
#        form:
#            type:               FOS\UserBundle\Form\ResettingFormType
#            handler:            FOS\UserBundle\Form\ResettingFormHandler
#            name:               fos_user_resetting_form
#            validation_groups:  [ResetPassword]
   service:
#        mailer:                 fos_user.util.mailer.default
 #      email_canonicalizer:    fos_user.util.email_canonicalizer.default
 #      username_canonicalizer: fos_user.util.username_canonicalizer.default
       user_manager:           fos_user.user_manager.default
#    encoder:
#        algorithm:          sha512
#        encode_as_base64:   false
#        iterations:         1
   template:
       engine: twig
       theme:  CCDNUserUserBundle:Form:fields.html.twig
#    group:
#        group_class:    ~ # Required when using groups
#        form:
#            type:               FOS\UserBundle\Form\GroupFormType
#            handler:            FOS\UserBundle\Form\GroupHandler
#            name:               fos_user_group_form
#            validation_groups:  [Registration]


# for CCDNUser MemberBundle    
ccdn_user_member:
    user:
        profile_route: cc_profile_show_by_id 
    members_per_page: 50       
    template:
        engine: twig
        theme: CCDNUserMemberBundle:Form:fields.html.twig
    member:
        layout_templates:
            list: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig

# for CCDNUser ProfileBundle
ccdn_user_profile:
    user:
        profile_route: cc_profile_show_by_id 
    template:
        engine: twig
        theme: CCDNUserProfileBundle:Form:fields.html.twig
    profile:
        layout_templates:
            edit: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            show: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
         
# for CCDNUser UserAdminBundle   
ccdn_user_user_admin:
    user:
        profile_route: cc_profile_show_by_id 
    template:
        engine: twig
        theme: CCDNUserUserAdminBundle:Form:fields.html.twig
    activation:
        layout_templates:
            show_unactivated_users: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    ban:
        layout_templates:
            show_banned_users: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    role:
        layout_templates:
            set_users_role: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    account:
        layout_templates:
            edit_user: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            show_newest_users: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            show_user: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig

# for CCDNUser UserBundle   
ccdn_user_user:
    user:
        profile_route: cc_profile_show_by_id 
    template:
        engine: twig
        theme: CCDNUserUserBundle:Form:fields.html.twig
    account:
        layout_templates:
            edit: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            show: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig     
    password:
        layout_templates:
            change_password: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    registration:
        layout_templates:
            check_email: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            confirmed: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            register: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    resetting:
        layout_templates:
            check_email: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            password_already_requested: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            request: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            reset: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
    security:
        layout_templates:
            login: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
```   

4) In your app/config/routing.yml add:  

```php
member:  
    resource: "@CCDNUserMemberBundle/Resources/config/routing.yml"  
profile:
    resource: "@CCDNUserProfileBundle/Resources/config/routing.yml"  
user_admin:
    resource: "@CCDNUserUserAdminBundle/Resources/config/routing.yml"  
user:
    resource: "@CCDNUserUserBundle/Resources/config/routing.yml"  
```

5) Symlink assets to your public web directory by running this in the command line:

```php
    php app/console assets:install --symlink web/
```

Then your done, if you need further help/support, have suggestions or want to contribute please join the community at [www.codeconsortium.com](http://www.codeconsortium.com)
