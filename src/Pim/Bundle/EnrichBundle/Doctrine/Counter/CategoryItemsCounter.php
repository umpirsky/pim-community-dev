<?php

namespace Pim\Bundle\EnrichBundle\Doctrine\Counter;

use Pim\Component\Classification\Model\CategoryInterface;
use Pim\Component\Classification\Repository\CategoryRepositoryInterface;
use Pim\Component\Classification\Repository\ItemCategoryRepositoryInterface;

/**
 * Count item in a category
 *
 * @author    Marie Bochu <marie.bochu@akeneo.com>
 * @copyright 2015 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class CategoryItemsCounter implements CategoryItemsCounterInterface
{
    /** @var ItemCategoryRepositoryInterface */
    protected $itemRepository;

    /** @var CategoryRepositoryInterface */
    protected $categoryRepository;

    /**
     * Constructor
     *
     * @param ItemCategoryRepositoryInterface $itemRepository  Item category repository
     * @param CategoryRepositoryInterface     $categoryRepo    Category repository
     */
    public function __construct(
        ItemCategoryRepositoryInterface $itemRepository,
        CategoryRepositoryInterface $categoryRepo
    ) {
        $this->itemRepository     = $itemRepository;
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * {@inheritdoc}
     */
    public function getItemsCountInCategory(CategoryInterface $category, $inChildren = false, $inProvided = true)
    {
        $categoryQb = null;
        if ($inChildren) {
            $categoryQb = $this->categoryRepository->getAllChildrenQueryBuilder($category, $inProvided);
        }

        return $this->itemRepository->getItemsCountInCategory($category, $categoryQb);
    }
}
