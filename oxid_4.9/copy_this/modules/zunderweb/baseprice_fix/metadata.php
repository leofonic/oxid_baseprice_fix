<?php
$aModule = array(
    'id'          => 'baseprice_fix',
    'title'       => 'Zunderweb Fix Baseprice',
    'description' =>  array(
        'de'=>'Zeigt den korrekten Grundpreis der Variante bei "von"-Preisen an',
        'en'=>'Shows correct variant baseprice of range prices',
    ),
    'version'     => '1.0',
    'url'         => 'http://zunderweb.de',
    'email'       => 'info@zunderweb.de',
    'author'      => 'Zunderweb',
    'extend'      => array(
        'oxarticle' => 'zunderweb/baseprice_fix/models/baseprice_fix_oxarticle',
    ),
);
