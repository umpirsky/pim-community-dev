<?php

namespace Pim\Bundle\EnrichBundle\Form\Type;

use Akeneo\Bundle\FileStorageBundle\Form\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form type linked to Media entity
 *
 * @author    Gildas Quemener <gildas@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class ImageType extends FileType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add(
                'removed',
                'checkbox',
                [
                    'required' => false,
                    'label'    => 'Remove media',
                ]
            )
            ->add('id', 'hidden');
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pim_enrich_image';
    }
}
