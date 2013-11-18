CCDNUser ProfileBundle Configuration Reference.
===============================================

All available configuration options are listed below with their default values.

``` yml
#
# for CCDNUser ProfileBundle
#
ccdn_user_profile:
    template:
        engine:               twig
    seo:
        title_length:         67
    profile:
        edit:
            personal:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                form_theme:           CCDNUserProfileBundle:Form:fields.html.twig
            contact:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                form_theme:           CCDNUserProfileBundle:Form:fields.html.twig
            avatar:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                form_theme:           CCDNUserProfileBundle:Form:fields.html.twig
            bio:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                form_theme:           CCDNUserProfileBundle:Form:fields.html.twig
                enable_bb_editor:     true
            signature:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                form_theme:           CCDNUserProfileBundle:Form:fields.html.twig
                enable_bb_editor:     true
        show:
            requires_login:       true
            overview:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
                member_since_datetime_format:  d-m-Y - H:i
                last_login_datetime_format:  d-m-Y - H:i
            bio:
                layout_template:      CCDNComponentCommonBundle:Layout:layout_body_right.html.twig
    item_bio:
        enable_bb_parser:     true
    item_signature:
        enable_bb_parser:     true

```

- [Return back to the docs index](index.md).
