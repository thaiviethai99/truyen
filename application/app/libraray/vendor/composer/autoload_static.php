<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4a4ff6ee5de1f10f017560f3e94baf13
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Slydepay\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Slydepay\\' => 
        array (
            0 => __DIR__ . '/..' . '/slydepay/slydepay-soap/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4a4ff6ee5de1f10f017560f3e94baf13::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4a4ff6ee5de1f10f017560f3e94baf13::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}