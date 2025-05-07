<x-mail::message>
Dear <b>{{ $lead->name }}</b>

Thank you for reaching out to us regarding your custom neon sign!

We have received your mockup design request, which can take up to 12 business hours to process. You will hear from us once your design is ready along with the proposal.

# Request ID: #{{ Str::afterLast($lead->uuid, '-') }}

If you have any questions regarding our design services, please don’t hesitate to contact our support team on

**WhatsApp Support:** <span class="phone">+1 (647) 616-5799</span>

Best regards,<br>
**VitalNeon**
</x-mail::message>