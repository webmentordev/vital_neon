<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
    xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc>https://vitalneon.com</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.00</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/support</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/create-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/upload-design</loc>
        <lastmod>2023-04-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/neon-sign-free-mockup-and-quote</loc>
        <lastmod>2025-05-18T05:05:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
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
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/f-a-q</loc>
        <lastmod>2023-08-28T13:40:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/blogs</loc>
        <lastmod>2025-11-06T13:40:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/terms-of-service</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/privacy-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/return-policy</loc>
        <lastmod>2024-01-23T13:48:00+05:00</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.90</priority>
    </url>

    <url>
        <loc>{{ url('/') }}/dmca-policy</loc>
        <lastmod>2024-03-06T13:48:00+05:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>
    <url>
        <loc>{{ url('/') }}/lightboxes</loc>
        <lastmod>2024-05-05T13:48:00+05:00</lastmod>
        <changefreq>daily</changefreq>
        <priority>0.90</priority>
    </url>

    @foreach ($categories as $category)
        <url>
            <loc>{{ url('/') }}/products/category/{{ $category->slug }}</loc>
            <lastmod>{{ $category->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>daily</changefreq>
            <priority>0.80</priority>
        </url>
    @endforeach
    @foreach ($blogs as $blog)
        <url>
            <loc>{{ url('/') }}/blog/{{ $blog->slug }}</loc>
            <lastmod>{{ $blog->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <changefreq>weekly</changefreq>
            <created>{{ $blog->created_at->tz('UTC')->toAtomString() }}</created>
            <priority>0.80</priority>
        </url>
    @endforeach
    @foreach ($products as $product)
        <url>
            <loc>{{ url('/') }}/product/{{ $product->slug }}</loc>
            <lastmod>{{ $product->updated_at->tz('UTC')->toAtomString() }}</lastmod>
            <created>{{ $product->created_at->tz('UTC')->toAtomString() }}</created>
            <changefreq>daily</changefreq>
            <priority>0.90</priority>
        </url>
    @endforeach
    @if (count($lightboxes))
        @foreach ($lightboxes as $box)
            <url>
                <loc>{{ url('/') }}/lightbox/{{ $box->slug }}</loc>
                <lastmod>{{ $box->updated_at->tz('UTC')->toAtomString() }}</lastmod>
                <created>{{ $box->created_at->tz('UTC')->toAtomString() }}</created>
                <changefreq>daily</changefreq>
                <priority>0.90</priority>
            </url>
        @endforeach
    @endif
</urlset>