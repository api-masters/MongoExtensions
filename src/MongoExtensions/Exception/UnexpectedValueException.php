<?php

namespace MongoExtensions\Exception;

use MongoExtensions\Exception;

/**
 * UnexpectedValueException
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
class UnexpectedValueException
    extends \UnexpectedValueException
    implements Exception
{
}
