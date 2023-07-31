<x-mail::message>
# Order Confirmation  
Dear <b>Customer</b>,  

We hope this email finds you well. I am writing to inform you that your order has been placed. We have assigned you the order id.   
# Paid: ${{ $data[1] }}
Please keep this order id safe and secure, as it will be required every time you contact our support team. We understand the importance of protecting your privacy and security, and we assure you that your order id will be kept confidential and only used for the purposes of providing you with the best possible support.    

If you have any questions or concerns regarding your order, please do not hesitate to reach out to us at <b>contact@vitalneon.com</b> or <b>Whatsapp</b> Our support team will be happy to assist you with any inquiries you may have.  
Thank you for choosing our services and for entrusting us with your support needs. We look forward to continuing to serve you.
  
### OrderID:  
{{ $data[0] }}

Best Regards,  
<b>VitalNeon Support</b>
</x-mail::message>