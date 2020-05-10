<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4398e11567b77f4185d85027432ae743
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Sandrocagara\\Multiauth\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Sandrocagara\\Multiauth\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4398e11567b77f4185d85027432ae743::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4398e11567b77f4185d85027432ae743::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
