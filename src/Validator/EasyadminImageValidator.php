<?php

namespace App\Validator;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\ImageValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EasyadminImageValidator extends ImageValidator
{
   public function validate($value, Constraint $constraint)
   {
       if (!$constraint instanceof EasyadminImage) {
           throw new UnexpectedTypeException($constraint, EasyadminImage::class);
       }
       if ($value instanceof UploadedFile)
           parent::validate($value, $constraint);
   }

}
