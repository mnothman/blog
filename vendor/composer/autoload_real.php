<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInite0c8f0bca6ac68ddb02ec7190c1bf43b
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInite0c8f0bca6ac68ddb02ec7190c1bf43b', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInite0c8f0bca6ac68ddb02ec7190c1bf43b', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInite0c8f0bca6ac68ddb02ec7190c1bf43b::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
