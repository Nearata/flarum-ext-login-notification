<?php

namespace Nearata\LoginNotification;

use Flarum\Extend;
use Flarum\User\Event\LoggedIn;
use Nearata\LoginNotification\Listener\UserLoggedInListener;

return [
    (new Extend\Frontend('forum'))
        ->js(__DIR__.'/js/dist/forum.js')
        ->css(__DIR__.'/less/forum.less'),

    (new Extend\Frontend('admin'))
        ->js(__DIR__.'/js/dist/admin.js')
        ->css(__DIR__.'/less/admin.less'),

    new Extend\Locales(__DIR__.'/locale'),

    (new Extend\User)
        ->registerPreference('nearataLoginNotification', 'boolval', false),

    (new Extend\Event)
        ->listen(LoggedIn::class, UserLoggedInListener::class),
];
