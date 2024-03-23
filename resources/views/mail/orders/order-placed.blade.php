<x-mail::message>
# Order Placed

We've received your order details, and we're thrilled to assist you further. To proceed with the checkout process, please click the button below to access Stripe's secure checkout page.  
Please note that this link will expire in 6 hours. In case you have any difficulty or if the link expires, please feel free to reach out to us, and we'll be happy to assist you promptly.  

<x-mail::button :url="$checkoutid">
Checkout
</x-mail::button>

Thanks,<br>
VitalNeon
</x-mail::message>