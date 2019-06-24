<?php

namespace MongoExtensions\Mapping\Annotation;

use Doctrine\Common\Annotations\Annotation;

/**
 * SlugHandlerOption annotation for Sluggable behavioral extension
 *
 * @MongoExtensions\Slug(handlers={
 *      @MongoExtensions\SlugHandler(class="Some\Class", options={
 *          @MongoExtensions\SlugHandlerOption(name="relation", value="parent"),
 *          @MongoExtensions\SlugHandlerOption(name="separator", value="/")
 *      }),
 *      @MongoExtensions\SlugHandler(class="Some\Class", options={
 *          @MongoExtensions\SlugHandlerOption(name="option", value="val"),
 *          ...
 *      }),
 *      ...
 * }, separator="-", updatable=false)
 *
 * @Annotation
 *
 * @author Gediminas Morkevicius <gediminas.morkevicius@gmail.com>
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
final class SlugHandlerOption extends Annotation
{
    public $name;
    public $value;
}
