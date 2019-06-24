<?php

namespace MongoExtensions\Exception;

use MongoExtensions\Exception;

/**
 * InvalidArgumentException
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class InvalidArgumentException
    extends \InvalidArgumentException
    implements Exception
{
}
