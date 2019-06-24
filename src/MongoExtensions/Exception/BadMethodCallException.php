<?php

namespace MongoExtensions\Exception;

use MongoExtensions\Exception;

/**
 * BadMethodCallException
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class BadMethodCallException
    extends \BadMethodCallException
    implements Exception
{
}
