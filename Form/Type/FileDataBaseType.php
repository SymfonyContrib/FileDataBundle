<?php

namespace SymfonyContrib\Bundle\FileDataBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use SymfonyContrib\Bundle\FileFieldBundle\Helper\UploadHelper;

/**
 * Advanced file form field.
 */
class FileDataBaseType extends AbstractType
{
    public $class;
    public $helper;

    /**
     * @param string $class The model class name.
     * @param UploadHelper $helper
     */
    public function __construct($class, UploadHelper $helper)
    {
        $this->class = $class;
        $this->helper = $helper;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $fo = $options['fields'];

        // Name field is required. Defaults to hidden field.
        if (empty($fo['name'])) {
            $builder->add('name', 'hidden', [
                'attr' => [
                    'class' => 'filefield-value',
                ]
            ]);
        }

        foreach ($fo as $name => $field) {
            $builder->add($name, $field['type'], $field['options']);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $data = $view->vars['value'];

        $filefield = $options['filefield_options'];

        $file = [];
        if (!empty($data)) {
            $name = $data->getFilename();
            $mime = $data->getMimeType();
            $size = $data->getSize();
            $icon = $this->helper->getFileIcon($mime);
            $file = [
                'name' => $name,
                'iconUri' => $this->helper->getIconUri() . $icon,
                'size' => $this->helper->formatSize($size),
                'uri' => $filefield['uri'] . $name,
            ];
        }

        $vars = [
            'multiple' => $filefield['multiple'],
            'preview_type' => $filefield['preview_type'],
            'file' => $file,
            'is_prototype' => ($view->vars['name'] === $filefield['prototype_name']),
        ];

        $view->vars = array_replace($view->vars, $vars);
    }

    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => $this->class,
            'compound' => true,
            'label' => false,
            'fields' => [],
            'filefield_options' => [],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'file_data_base';
    }

}
