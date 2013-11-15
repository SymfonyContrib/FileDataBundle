**This code is part of the [SymfonyContrib](http://symfonycontrib.com/) community.**

# Symfony2 FileDataBundle

Provides a basis for creating local content management for files.

## Use Case
If you need to keep track of file uploads and data related to those files,
this bundle provides a good base (Doctrine mappedSuperClass) and features.

Example: Let's say you allow image uploads and would like to collect alt text,
width, and height values as well. This bundle allows you to collect as much or
as little information as you need about your files in a consistent manner.

###Features:

* Highly extensible & customizable.
* Needs to be extended by your own entity (Doctrine mappedSuperClass).
* Base form type to use or extend from.
* ...more to come.

## Installation

Installation is the same as a standard bundle.
http://symfony.com/doc/current/cookbook/bundles/installation.html

* Add bundle to composer.json: https://packagist.org/packages/symfonycontrib/filedata-bundle
* Add bundle to AppKernel.php:

```php
new SymfonyContrib\Bundle\FileDataBundle\FileDataBundle(),
```

## Usage Examples

Create an Entity in a bundle that extends the abstract base class.
The only field that is required in your entity is the primary key "id" field.

Here is a very basic example:

```php
<?php
namespace Acme\Bundle\FileDataBundle\Entity;

use SymfonyContrib\Bundle\FileDataBundle\Entity\FileDataBase;

class FileData extends FileDataBase
{
    protected $id;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
```

Create the appropriate Doctrine metadata in annotations, yml, or xml as you
would with any other entity for the primary key field and any other additional
fields you include in your entity.

## Configuration

In your application config.yml file, define your entity class.

```yml
file_data:
    model_class: Acme\Bundle\FileDataBundle\Entity\FileData
```

## Fields included in the base class

All fields below are optional except the name field.

* **name:** (string) (Required) Usually the filename, however, can be anything you identify the file with ID, hash, etc.
* **desc:** (string) Admin description or can be use for alt text, etc.
* **size:** (bigint) Size of the file in bytes.
* **mimeType:** (string) Mime(media) type of the file.
* **metaData:** (json array) Array of arbitrary data stored as json.
* **local:** (boolean) Whether the file is on the local file system.
* **created:** (date time) Date and time the file data entry was created. Automatically handled.
* **updated:** (date time) Date and time the file data entry was updated. Automatically handled.

