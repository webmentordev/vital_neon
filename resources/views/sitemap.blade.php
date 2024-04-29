<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>https://vitalneon.com</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/support</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/create-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/upload-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/products</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/about</loc>
        <lastmod>2023-08-28T13:40:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/f-a-q</loc>
        <lastmod>2023-08-28T13:40:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/blogs</loc>
        <lastmod>2023-01-24T13:40:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/terms-of-service</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/privacy-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/return-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>yearly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/dmca-policy</loc>
        <lastmod>2024-03-06T13:48:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/lightboxes</loc>
        <lastmod>2024-04-28T13:48:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/') }}/products/category/{{ $category->slug }}</loc>
            <lastmod>{{ $category->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>yearly</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/') }}/product/{{ $product->slug }}</loc>
            <lastmod>{{ $product->created_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <priority>0.90</priority>
        </url>
    @endforeach
    @if (count($lightboxes))
        @foreach ($lightboxes as $box)
            <url>
                <loc>{{ url('/') }}/lightbox/{{ $box->slug }}</loc>
                <lastmod>{{ $box->created_at->tz('UTC')->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.90</priority>
            </url>
        @endforeach
    @endif
</urlset>