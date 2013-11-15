<?php
namespace SymfonyContrib\Bundle\FileDataBundle\Form\DataTransformer;

use Junta\Bundle\FileDataBundle\Entity\FileData;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class StringToFileDataTransformer implements DataTransformerInterface
{
    public function transform($data)
    {
        $files = [];
        if (is_array($data) || ($data instanceof \Traversable && $data instanceof \ArrayAccess)) {
            foreach ($data as $key => $file) {
                $files[$key] = (string)$file;
            }
        }

        return $files;
    }

    public function reverseTransform($data)
    {
        if ($data === null || $data === '') {
            //return $this->multiple ? [] : null;
            return null;
        }

        if (is_array($data) || ($data instanceof \Traversable && $data instanceof \ArrayAccess)) {
            foreach ($data as $key => $value) {
                $file = new FileData();
                $file->setName($value);
                $data[$key] = $file;
            }

            return $data;
        } else {
            if (!is_string($data)) {
                throw new TransformationFailedException('Expected a string.');
            }
            $file = new FileData();
            $file->setName($data);

            return $file;
        }
    }
}
