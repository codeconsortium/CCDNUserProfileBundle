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

namespace CCDNUser\ProfileBundle\Form\Type\User\Profile;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 *
 * @category CCDNUser
 * @package  ProfileBundle
 *
 * @author   Reece Fowell <reece@codeconsortium.com>
 * @license  http://opensource.org/licenses/MIT MIT
 * @version  Release: 2.0
 * @link     https://github.com/codeconsortium/CCDNUserProfileBundle
 *
 */
class InfoFormType extends AbstractType
{
    /**
     *
     * @access protected
     * @var string $profileClass
     */
    protected $profileClass;

    /**
     *
     * @access public
     * @param string $profileClass
     */
    public function __construct($profileClass)
    {
        $this->profileClass = $profileClass;
    }

    /**
     *
     * @access public
     * @param FormBuilder $builder, array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('real_name', 'text',
                array(
                    'required'           => false,
                    'label'              => 'form.label.real_name',
                    'translation_domain' => 'CCDNUserProfileBundle',
                )
            )
            ->add('birth_date', 'birthday',
                array(
                    'required'           => false,
                    'label'              => 'form.label.birth_date',
                    'translation_domain' => 'CCDNUserProfileBundle',
                )
            )
            ->add('company', null,
                array(
                    'required'           => false,
                    'label'              => 'form.label.company',
                    'translation_domain' => 'CCDNUserProfileBundle',
                )
            )
            ->add('position', null,
                array(
                    'required'           => false,
                    'label'              => 'form.label.position',
                    'translation_domain' => 'CCDNUserProfileBundle',
                )
            )
        ;
    }

    /**
     *
     * @access public
     * @param \Symfony\Component\OptionsResolver\OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' 			=> $this->profileClass,
            'csrf_protection' 		=> true,
            'csrf_field_name' 		=> '_token',
            // a unique key to help generate the secret token
            'intention'       		=> 'profile_item_info',
            'validation_groups'		=> array('update_info'),
        ));
    }

    /**
     *
     * @access public
     * @return string
     */
    public function getName()
    {
        return 'ProfileInfo';
    }
}
