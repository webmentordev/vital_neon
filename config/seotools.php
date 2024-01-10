<?php
/**
 * @see https://github.com/artesaos/seotools
 */

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'        => "Buy Eye Catching Custom Neon Signs in US", // set false to total remove
            'titleBefore'  => "Vital Neon", // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description'  => "Buy Energy Efficient Water Proof Artistic Custom Neon Signs with Local Power Adaptor, Installation Kit and 2 Years warrenty in the US", // set false to total remove
            'separator'    => ' — ',
            'keywords'     => [],
            'canonical'    => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'robots'       => false, // Set to 'all', 'none' or any combination of index/noindex and follow/nofollow
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => null,
            'bing'      => null,
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => false, // set false to total remove
            'description' => "Buy Energy Efficient Water Proof Artistic Custom Neon Signs with Local Power Adaptor, Installation Kit and 2 Years warrenty in the US", // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => false,
            'site_name'   => 'VitalNeon',
            'images'      => [
                'https://vitalneon.com/assets/seo/home-2.png'
            ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'large_summary',
            'site'        => '@vitalneon',
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => "Buy Eye Catching Custom Neon Signs in US",
            'description' => "Buy Energy Efficient Water Proof Artistic Custom Neon Signs with Local Power Adaptor, Installation Kit and 2 Years warrenty in the US",
            'url'         => null, // Set to null or 'full' to use Url::full(), set to 'current' to use Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [
                'https://vitalneon.com/assets/seo/home-2.png'
            ],
        ],
    ],
];
