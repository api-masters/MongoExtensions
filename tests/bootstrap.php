<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Cache\ArrayCache;
use Composer\Autoload\ClassLoader;

/**
 * This is bootstrap for phpUnit unit tests,
 * use README.md for more details
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @author Christoph Krämer <cevou@gmx.de>
 * @link http://www.gediminasm.org
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

define('TESTS_PATH', __DIR__);
define('TESTS_TEMP_DIR', __DIR__.'/temp');
define('VENDOR_PATH', realpath(__DIR__.'/../vendor'));

/** @var $loader ClassLoader */
$loader = require __DIR__.'/../vendor/autoload.php';

$loader->add('MongoExtensions\\Mapping\\Mock', __DIR__);
$loader->add('Tool', __DIR__.'/MongoExtensions');
// fixture namespaces
$loader->add('Translator\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Translatable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Timestampable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Blameable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('IpTraceable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Tree\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Sluggable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Sortable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Mapping\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Loggable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('SoftDeletable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Uploadable\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('Wrapper\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('ReferenceIntegrity\\Fixture', __DIR__.'/MongoExtensions');
$loader->add('References\\Fixture', __DIR__.'/MongoExtensions');
// stubs
$loader->add('MongoExtensions\\Uploadable\\Stub', __DIR__);

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));
MongoExtensions\DoctrineExtensions::registerAnnotations();

$reader = new AnnotationReader();
$reader = new CachedReader($reader, new ArrayCache());
$_ENV['annotation_reader'] = $reader;
