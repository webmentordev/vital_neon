<?php

use App\Models\Lead;
use App\Mail\Testing;
use App\Mail\LeadRecieved;
use App\Mail\ProposalReady;
use App\Http\Livewire\Carts;
use App\Http\Livewire\Preview;
use App\Http\Livewire\Product;
use App\Http\Livewire\Auth\Leads;
use App\Http\Livewire\FreeMockup;
use App\Http\Livewire\DesignQuote;
use App\Http\Livewire\CreateDesign;
use App\Http\Livewire\Auth\Proposal;
use App\Http\Livewire\LightBoxIndex;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Artesaos\SEOTools\Facades\SEOMeta;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LineController;
use App\Http\Livewire\Auth\EditProposal;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShapeController;
use App\Http\Controllers\TrackController;
use App\Models\Proposal as ProposalModel;
use App\Http\Controllers\DesignController;
use App\Http\Controllers\RemoteController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SiteMapGenerator;
use App\Http\Livewire\Auth\CreateProposal;
use App\Models\Proposal as ModelsProposal;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\LightBoxController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryPriceController;
use App\Http\Controllers\PriceIncrementController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/create-design', CreateDesign::class)->name('create-design');
// Route::get('/create-design', [CreateDesignController::class, 'index'])->name('create-design');

Route::get("/about", function(){
    SEOMeta::setTitle("About VitalNeon");
    return view('about');
})->name('about');

Route::get("/f-a-q", function(){
    SEOMeta::setTitle("Frequently Asked Question | VitalNeon");
    return view('f-a-q');
})->name('f.a.q');

Route::get('/upload-your-own-design', [DesignController::class, 'index'])->name('upload-design');
Route::post('/upload-your-own-design', [DesignController::class, 'store'])->middleware(['throttle:60,5']);

Route::get('/neon-sign-free-mockup-and-quote', FreeMockup::class)->name('free.mockup');

Route::get('/cancel/{checkout_id}', [OrderController::class, 'cancel']);
Route::get('/success/{checkout_id}', [OrderController::class, 'success']);

Route::get('/cancel-order/{checkout_id}', [OrderController::class, 'cancelOrder']);
Route::get('/success-order/{checkout_id}', [OrderController::class, 'successOrder']);

Route::get('/cancel-lightbox-order/{lightbox:checkout_id}', [OrderController::class, 'lamp_order_cancel']);
Route::get('/success-lightbox-order/{lightbox:checkout_id}', [OrderController::class, 'lamp_order_success']);

Route::get('/product/{slug}', Product::class)->name('listing');
Route::get('/products', [ProductsController::class, 'index'])->name('products');
Route::get('/products/search', [ProductsController::class, 'search'])->name('product.search');
Route::get('/products/category/{category:slug}', [ProductsController::class, 'category'])->name('category.search');

Route::get("blogs", [BlogController::class, 'index'])->name('blogs');
Route::get("blog/{blog:slug}", [BlogController::class, 'read'])->name('blog.read');
Route::get("blogs/find/search", [BlogController::class, 'search'])->name('blog.search');

Route::get('/track-order', [TrackController::class, 'index'])->name('track');
Route::post('/track-order', [TrackController::class, 'search'])->name('track.search');

Route::get('/terms-of-service', [ServiceController::class, 'terms'])->name('terms');
Route::get('/privacy-policy', [ServiceController::class, 'privacy'])->name('privacy');
Route::get('/return-policy', [ServiceController::class, 'return'])->name('return');
Route::get('/dmca-policy', [ServiceController::class, 'dmca'])->name('dmca');


Route::get('/cart', Carts::class)->name('carts');

Route::get('/lightboxes', [LightBoxController::class, 'light_index'])->name('lightboxes');
Route::get('/lightbox/{lightbox:slug}', LightBoxIndex::class)->name('lightboxe.product');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/preview', Preview::class)->name('preview');

    Route::get('/shape', [ShapeController::class, 'index'])->name('shape');
    Route::post('/shape', [ShapeController::class, 'create']);

    Route::get('/remote', [RemoteController::class, 'index'])->name('remote');
    Route::post('/remote', [RemoteController::class, 'create']);

    Route::get('leads', Leads::class)->name('admin.leads');

    Route::get('proposals', Proposal::class)->name('admin.proposals');
    Route::get('/proposal/create', CreateProposal::class)->name('admin.create.proposals');
    Route::get('/proposal/edit/{proposal}', EditProposal::class)->name('admin.edit.proposal');
    
    Route::get('/lines', [LineController::class, 'index'])->name('line');
    Route::post('/lines', [LineController::class, 'create']);

    Route::get('/product-price', [CategoryPriceController::class, 'index'])->name('product.price');
    Route::post('/product-price', [CategoryPriceController::class, 'create']);
    Route::patch('/product-price/update/{id}', [CategoryPriceController::class, 'update'])->name('product.price.update');
    Route::delete('/product-price/delete/{price}', [CategoryPriceController::class, 'delete'])->name('product.price.delete');

    Route::get('/product-category', [CategoryController::class, 'index'])->name('product.category');
    Route::post('/product-category', [CategoryController::class, 'store']);
    Route::get('/update-category/page/{category}', [CategoryController::class, 'update_index'])->name('category.update');
    Route::post('/update-category/{category}', [CategoryController::class, 'update_store'])->name('update.category');

    Route::get('/product', [ProductController::class, 'index'])->name('product');
    Route::post('/upload', [ProductController::class, 'upload'])->name('upload');
    Route::post('/product', [ProductController::class, 'create']);
    Route::get('/product/{product:slug}/update', [ProductController::class, 'update'])->name('product.update');
    Route::patch('/product/update/{product:slug}', [ProductController::class, 'update_product'])->name('update.product');
    Route::patch('/product/{product:slug}/status', [ProductController::class, 'status'])->name('product.status');
    Route::patch('/product/{product:slug}/featured', [ProductController::class, 'featured'])->name('product.feature');

    Route::get('/design-quote', DesignQuote::class)->name('design.quote');

    Route::get('/searches', [SearchController::class, 'index'])->name('searches');
    Route::delete('/searche/delete/{search}', [SearchController::class, 'delete'])->name('searche.delete');
    
    Route::get('/designs/show', [DesignController::class, 'show'])->name('designs.show');

    Route::get('/orders', [OrderController::class, 'orders'])->name('orders.show');
    Route::patch('/orders/status/update/{checkout_id}', [OrderController::class, 'orderUpdate'])->name('orders.status');

    Route::get('/create-blog', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/create-blog', [BlogController::class, 'store']);

    Route::get('/blogs/show', [BlogController::class, 'show'])->name('blogs.show');
    Route::get('/blog/update/{blog:slug}', [BlogController::class, 'update'])->name('blog.update');
    Route::patch('/blog/update/{blog:slug}', [BlogController::class, 'update_blog'])->name('update.blog');
    Route::post('/blog/status/{blog}', [BlogController::class, 'status_blog'])->name('status.blog');

    Route::get('/blog/show/images', [BlogController::class, 'image_uploads'])->name('images.blog');
    Route::post('/blog/delete/image/{upload}', [BlogController::class, 'delete_image'])->name('image.blog.delete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/cart/dates/search', [DashboardController::class, 'cart_search'])->name('cart.search');
    Route::get('/orders/dates/search', [DashboardController::class, 'order_search'])->name('order.search');

    Route::get('/price-percentage', [PriceIncrementController::class, 'index'])->name('price.percentage');
    Route::post('/price-percentage', [PriceIncrementController::class, 'store']);


    Route::get('/price-discount', [DiscountController::class, 'index'])->name('price.discount');
    Route::post('/price-discount', [DiscountController::class, 'store']);
    Route::delete('/price-discount/delete/{id}', [DiscountController::class, 'delete'])->name('price.discount.delete');

    Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
    Route::get('/create/review', [ReviewController::class, 'create'])->name('create.review');
    Route::post('/post/review', [ReviewController::class, 'store'])->name('post.review');
    Route::get('/post/review/{review:id}', [ReviewController::class, 'update'])->name('review.update');
    Route::patch('/post/review/update/{review:id}', [ReviewController::class, 'review_update'])->name('update.review');

    Route::get('/send-email', [EmailController::class, 'index'])->name('email.send');
    Route::post('/email/send', [EmailController::class, 'store'])->name('send.email');


    Route::get('/preview-email', [EmailController::class, 'preview'])->name('email.preview');
    Route::post('/email/preview', [EmailController::class, 'show'])->name('preview.email');


    Route::get('/light-box', [LightBoxController::class, 'index'])->name('lightbox');
    Route::get('/light-box/orders', [LightBoxController::class, 'orders'])->name('lightbox.orders');
    Route::post('/light-box/create', [LightBoxController::class, 'store'])->name('lightbox.create');
    Route::get('/light-box/{light_box:slug}', [LightBoxController::class, 'update'])->name('lightbox.update');
    Route::patch('/light-box/{light_box:slug}/update', [LightBoxController::class, 'update_box'])->name('update.lightbox');
    Route::patch('/light-box/{light_box:slug}/status', [LightBoxController::class, 'status'])->name('status.lightbox');
    Route::patch('/light-box/{light_box:slug}/feature', [LightBoxController::class, 'feature'])->name('feature.lightbox');

    Route::patch('/light-box/order/update/{order:checkout_id}/', [LightBoxController::class, 'order_status'])->name('order.status');

    Route::get("/get-pdf", [PDFController::class, 'index']);
    Route::get("/generate-pdf", [PDFController::class, 'store']);

    Route::get('/email-test', function(){
        $proposal = ProposalModel::latest()->first();
        return new ProposalReady($proposal->name, $proposal);
    });

    Route::get('/ui/image/{image}/{proposal}', function($image, ModelsProposal $proposal){
        $payload = json_decode($proposal->payload, true);
        foreach($payload as $single_payload) {
            return view("templates.". $image, [
                "data" => $single_payload,
            ]);
        }
    }); 

    Route::get('/ui/{proposal}/{pdf}', function(ModelsProposal $proposal, $pdf){
        $payload = json_decode($proposal->payload, true);
        foreach($payload as $single_payload) {
            return view("templates.".$pdf, [
                "data" => $single_payload,
                "proposal" => $proposal
            ]);
        }
    });
});

Route::get('/sitemap.xml', [SiteMapGenerator::class, 'index'])->name('sitemap');

require __DIR__.'/auth.php';