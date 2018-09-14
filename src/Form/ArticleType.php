<?php
/**
 * Created by PhpStorm.
 * User: greg
 * Date: 14/09/18
 * Time: 13:40
 */

namespace App\Form;

use App\Entity\Article;
use App\Entity\Heading;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('position')
            ->add('file', FileType::class, array('label' => 'Image', 'required' => false, 'data_class' => null))
            ->add('heading', EntityType::class,[
                'class'=>Heading::class,
                'choice_label' => 'title'])        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
