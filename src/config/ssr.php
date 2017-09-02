<?php
return [

    'enable' => true,

    /*
     * lifetime in minutes of generated pages
     */

    'lifetime' => 60*24*7,

    /*
     * request timeout of phantomjs
     */

    'timeout' => 5000,

    /*
     * location of your phantomjs binary
     */

    'phantom_location' => storage_path('app/phantomjs'),

];