<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite0c8f0bca6ac68ddb02ec7190c1bf43b
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Blog\\' => 5,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Blog\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite0c8f0bca6ac68ddb02ec7190c1bf43b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite0c8f0bca6ac68ddb02ec7190c1bf43b::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite0c8f0bca6ac68ddb02ec7190c1bf43b::$classMap;

        }, null, ClassLoader::class);
    }
}
