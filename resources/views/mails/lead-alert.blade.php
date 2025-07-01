<x-mail::message>
A new lead has been recieved at vitalneon.

# Request ID: #{{ Str::afterLast($lead->uuid, '-') }}

**WhatsApp Support:** <span class="phone">+1 (647) 616-5799</span>

Best regards,<br>
**VitalNeon**
</x-mail::message>
