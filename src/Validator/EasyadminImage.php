<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints\Image;

/**
 * @Annotation
 *
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class EasyadminImage extends Image
{

}