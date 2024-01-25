<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>https://vitalneon.com</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>https://vitalneon.com/support</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://vitalneon.com/create-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://vitalneon.com/upload-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>https://vitalneon.com/products</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/about</loc>
        <lastmod>2023-08-28T13:40:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/f-a-q</loc>
        <lastmod>2023-08-28T13:40:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/blogs</loc>
        <lastmod>2023-01-24T13:40:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/terms-of-service</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/privacy-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>https://vitalneon.com/return-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/') }}/products/category/{{ $category->slug }}</loc>
            <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ url('/') }}/blog/{{ $blog->slug }}</loc>
            <lastmod>{{ $blog->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/') }}/product/{{ $product->slug }}</loc>
            <lastmod>{{ $product->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
</urlset>