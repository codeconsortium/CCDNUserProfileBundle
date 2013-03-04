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
class ProfileContactType extends AbstractType
{

    /**
     *
     * @access public
     * @param FormBuilder $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
	        ->add('msn', null, array(
				'label' => 'ccdn_user_profile.form.label.profile.edit.msn',
	        	'translation_domain' => 'CCDNUserProfileBundle',
	        ))
	        ->add('msn_is_public', 'checkbox', array(
				'required' => false,
				'label' => 'ccdn_user_profile.form.label.profile.edit.msn_is_public',
				'translation_domain' => 'CCDNUserProfileBundle',
			))
	        ->add('yahoo', null, array(
				'label' => 'ccdn_user_profile.form.label.profile.edit.yahoo',
	        	'translation_domain' => 'CCDNUserProfileBundle',
	        ))
	        ->add('yahoo_is_public', 'checkbox', array(
				'required' => false,
				'label' => 'ccdn_user_profile.form.label.profile.edit.yahoo_is_public',
				'translation_domain' => 'CCDNUserProfileBundle',
			))
            ->add('aim', null, array(
				'label' => 'ccdn_user_profile.form.label.profile.edit.aim',
            	'translation_domain' => 'CCDNUserProfileBundle',
            ))
            ->add('aim_is_public', 'checkbox', array(
				'required' => false,
				'label' => 'ccdn_user_profile.form.label.profile.edit.aim_is_public',
				'translation_domain' => 'CCDNUserProfileBundle',
			))
            ->add('icq', null, array(
				'label' => 'ccdn_user_profile.form.label.profile.edit.icq',
            	'translation_domain' => 'CCDNUserProfileBundle',
            ))
            ->add('icq_is_public', 'checkbox', array(
				'required' => false,
				'label' => 'ccdn_user_profile.form.label.profile.edit.icq_is_public',
				'translation_domain' => 'CCDNUserProfileBundle',
			));
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
            'validation_groups' 	=> 'contact',
        );
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'ProfileContact';
    }

}
