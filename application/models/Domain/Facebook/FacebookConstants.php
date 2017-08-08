<?php

namespace Model\Domain\Facebook;

//TODO Sinisa - move ti application.ini - secret data
class FacebookConstants
{
    const APP_ID_NAME       = 'app_id';
    const APP_SECRET_NAME   = 'app_secret';
    const APP_ID            = '293452894412675';
    const APP_SECRET        = 'ac7d9bcc484d5f6e6186218b3b78d022';
    const GRAPH_VERSION     = 'v2.9';

    const ID                = 'id';
    const FIRST_NAME        = 'first_name';
    const LAST_NAME         = 'last_name';
    const GENDER            = 'gender';
    const LOCALE            = 'locale';
    const PICTURE           = 'picture';
    const TOKEN             = 'token';
    const LINK              = 'link';
    const URL               = 'url';
    const IS_ACTIVE         = 'is_active';
    const TS_CREATED        = 'ts_created';
    const TS_UPDATED        = 'ts_updated';

    const PROFILE_RESPONSE  = 'profile';
    const LOGOUT_RESPONSE   = 'logout_url';

    const FB_LOGIN_URL      = 'fb_login_url';
    const FB_LOGOUT_URL     = 'http://localhost/facebook/public/index.php';
    const FB_CALLBACK_URL   = 'http://docs.nd.dev/facebook';
}