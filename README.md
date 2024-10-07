# DwmdTwigCmsPageLoader

### Shopware 6 Twig Function to load CMS Page
This plugin lets you load Shopware CMS Pages in twig using a custom twig function. 

## Installation
1. download zip-file
2. upload in shopware administration: `Extensions > My extensions > Upload extension`
3. activate `DwmdTwigCmsPageLoader` Plugin
4. clear cache via console `bin/console cache:clear` or `Settings > Caches & indexes > Clear caches`


## Usage
You can render Shopware CMS Pages with this twig function `{{ cms_page('YourCmsPageId', context) }}` 

The function needs a CmsPageId as a string and the current SalesChannelContext.

## Example 

We can render the shopware contact form anywhere we want using this snippet:

`{{ cms_page(config('core.basicInformation.contactPage'), context) }}`