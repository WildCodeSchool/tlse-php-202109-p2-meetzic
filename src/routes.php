<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/item/edit?id=1' will execute $itemController->edit(1)

use App\Controller\SessionController;

return [
    '' => ['IndexController', 'index',],
    'home' => ['AdController', 'browse',],
    'home/search' => ['AdController', 'browseBySearch', ['query']],
    'profile' => ['ProfileController', 'show', ['id']],
    'private' => ['ProfileController', 'profileView'],
    'login' => ['SessionController', 'login'],
    'new' => ['SessionController', 'creation'],
    'about' => ['AboutController', 'about'],
    'private/add' => ['ProfileController', 'addProfile'],
    'private/show' => ['ProfileController', 'showProfileValidate', ['id']],
    'private/delete' => ['ProfilController', 'deleteById', ['id']],
];
