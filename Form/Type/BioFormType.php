<?php

/*
 * This file is part of the CCDNUser ProfileBundle
 *
 * (c) CCDN (c) CodeConsortium <http://www.codeconsortium.com/>
 *
 * Available on github <http://www.github.com/codeconsortium/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace CCDNUser\ProfileBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 *
 * @author Reece Fowell <reece@codeconsortium.com>
 * @version 1.0
 */
class BioFormType extends AbstractType
{
    /**
     *
     * @access public
     * @param FormBuilder $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('bio', 'bb_editor',
				array(
					'label' => 'ccdn_user_profile.form.label.profile.edit.bio',
	            	'translation_domain' => 'CCDNUserProfileBundle',
	            )
			)
		;
    }

    /**
     *
     * @access public
     * @param array $options
     */
    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' 			=> 'CCDNUser\ProfileBundle\Entity\Profile',
            'csrf_protection' 		=> true,
            'csrf_field_name' 		=> '_token',
            // a unique key to help generate the secret token
            'intention'       		=> 'profile_item',
            'validation_groups'		=> 'bio',
        );
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'ProfileBio';
    }
}