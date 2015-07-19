<?php

namespace PromptBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class WeeklyPromptPollType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateCreated')
            ->add('dateStart')
            ->add('dateEnd')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PromptBundle\Entity\WeeklyPromptPoll'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'promptbundle_weeklypromptpoll';
    }
}
