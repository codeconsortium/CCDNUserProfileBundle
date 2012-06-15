CCDNUser ProfileBundle Configuration Reference.
===============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser ProfileBundle
#
ccdn_user_profile:
    user:
        profile_route: cc_profile_show_by_id 
    template:
        engine: twig
    profile:
#        edit:
#            layout_template: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
#            form_theme: CCDNUserProfileBundle:Form:fields.html.twig
        show:
            layout_template: CCDNComponentCommonBundle:Layout:layout_body_left.html.twig
            member_since_datetime_format: "d-m-Y - H:i"
            last_login_datetime_format: "d-m-Y - H:i"
            requires_login: false
    sidebar:
        members_route: cc_members_index
        account_route: cc_user_account_show

```

- [Return back to the docs index](index.md).
