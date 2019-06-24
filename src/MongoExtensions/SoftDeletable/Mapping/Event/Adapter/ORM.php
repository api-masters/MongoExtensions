<?php

namespace MongoExtensions\SoftDeletable\Mapping\Event\Adapter;

use MongoExtensions\Mapping\Event\Adapter\ORM as BaseAdapterORM;
use MongoExtensions\SoftDeletable\Mapping\Event\SoftDeletableAdapter;

/**
 * Doctrine event adapter for ORM adapted
 * for SoftDeletable behavior.
 *
 * @author David Buchmann <mail@davidbu.ch>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
final class ORM extends BaseAdapterORM implements SoftDeletableAdapter
{
}
