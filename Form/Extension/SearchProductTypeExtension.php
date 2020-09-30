<?php

namespace Plugin\ShoppingMall\Form\Extension;

use Eccube\Form\Type\SearchProductType;
use Plugin\ShoppingMall\Entity\Shop;
use Plugin\ShoppingMall\Repository\ShopRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormBuilderInterface;

class SearchProductTypeExtension extends AbstractTypeExtension
{
    /**
     * @var ShopRepository
     */
    protected $shopRepository;

    /**
     * SearchOrderTypeExtension constructor.
     *
     * @param ShopRepository $shopRepository
     */
    public function __construct(ShopRepository $shopRepository)
    {
        $this->shopRepository = $shopRepository;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('shop_id', EntityType::class, [
            'class' => Shop::class,
            'choice_label' => 'name',
            'choices' => $this->shopRepository->findBy([], ['sort_no' => 'DESC']),
            'required' => false,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getExtendedType()
    {
        return SearchProductType::class;
    }
}
