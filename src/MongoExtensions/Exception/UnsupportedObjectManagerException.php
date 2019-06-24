<?php

namespace MongoExtensions\Exception;

use MongoExtensions\Exception;

/**
 * UnsupportedObjectManager
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class UnsupportedObjectManagerException
    extends InvalidArgumentException
    implements Exception
{
}
