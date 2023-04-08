<x-mail::message>
# Support Request  
Dear <b>{{ $data->name }}</b>,  

I hope this email finds you well. I am writing to inform you that your support token has been generated and is now ready for use. The support token is a unique identifier that will allow us to verify your identity when you contact us for any support-related queries or concerns.    

Please keep this token safe and secure, as it will be required every time you contact our support team. We understand the importance of protecting your privacy and security, and we assure you that your support token will be kept confidential and only used for the purposes of providing you with the best possible support.    

If you have any questions or concerns regarding your support token, please do not hesitate to reach out to us at <b>contact@vitalneon.com</b> Our support team will be happy to assist you with any inquiries you may have.  
Thank you for choosing our services and for entrusting us with your support needs. We look forward to continuing to serve you.
  
### Token:  
{{ $data->ticket }}

Best Regards,  
<b>VitalNeon Support</b>
</x-mail::message>
