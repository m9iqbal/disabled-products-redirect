<?php

namespace MediaLounge\DisabledProductsRedirect\Controller\Catalog\Product;

class View extends \Magento\Catalog\Controller\Product\View
{
    protected $redirectHelper;

    protected $productRepository;

    protected $categoryRepository;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Catalog\Helper\Product\View $viewHelper,
        \Magento\Framework\Controller\Result\ForwardFactory $resultForwardFactory,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \MediaLounge\DisabledProductsRedirect\Helper\Data $redirectHelper,
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Catalog\Model\CategoryRepository $categoryRepository
    ) {
        $this->redirectHelper     = $redirectHelper;
        $this->productRepository  = $productRepository;
        $this->categoryRepository = $categoryRepository;

        parent::__construct($context, $viewHelper, $resultForwardFactory, $resultPageFactory);
    }

    public function execute()
    {
        $redirectEnabled = $this->redirectHelper->isEnabled();

        if ($redirectEnabled) {
            $productId = (int) $this->getRequest()->getParam('id');
            $product   = $this->productRepository->getById($productId);

            if ($product && $product->isDisabled()) {
                $productCategories = $product->getCategoryIds();
                $firstParentId     = array_shift($productCategories);

                if (!empty($firstParentId)) {
                    $noticeMessage = $this->redirectHelper->getNoticeMessage();
                    $category      = $this->categoryRepository->get($firstParentId);

                    $this->messageManager->addNoticeMessage($noticeMessage);

                    return $this->resultRedirectFactory->create()->setUrl($category->getUrl());
                }
            }
        }

        return parent::execute();
    }
}
