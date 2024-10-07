<?php declare(strict_types=1);

namespace Dwmd\TwigCmsPageLoader\Twig;

use Twig\Markup;
use Twig\Environment;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Symfony\Component\HttpFoundation\RequestStack;
use Shopware\Core\System\SalesChannel\SalesChannelContext;
use Shopware\Core\Framework\DataAbstractionLayer\Search\Criteria;
use Shopware\Core\Content\Cms\SalesChannel\SalesChannelCmsPageLoaderInterface;

class CmsPageLoaderExtension extends AbstractExtension
{
    public function __construct(
        private readonly Environment $twig,
        private readonly RequestStack $request,
        private readonly SalesChannelCmsPageLoaderInterface $cmsPageLoader
    ) {
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('cms_page', [$this, 'loadCmsPage']),
        ];
    }

    public function loadCmsPage(string $cmsPageId, SalesChannelContext $context)
    {
        $cmsPages = $this->cmsPageLoader->load($this->request->getCurrentRequest(), new Criteria([$cmsPageId]), $context);

        if (!$cmsPages->has($cmsPageId)) {
            return;
        }

        return new Markup($this->twig->render('@Storefront/storefront/page/content/detail.html.twig', ['cmsPage' => $cmsPages->get($cmsPageId)]), 'UTF-8');
    }
}