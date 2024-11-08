<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitce118f4343c6390749c04e96bb334518
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Core\\' => 5,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Core\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Core',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitce118f4343c6390749c04e96bb334518::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitce118f4343c6390749c04e96bb334518::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitce118f4343c6390749c04e96bb334518::$classMap;

        }, null, ClassLoader::class);
    }
}
