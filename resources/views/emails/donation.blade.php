<x-mail::message>

# New Donation Received

**Name:** {{ $data['name'] }}  
**Email:** {{ $data['email'] }}  
**Amount:** {{ $data['amount'] }} TZS  
**Payment Method:** {{ $data['method'] }}  
**Message:** {{ $data['message'] ?? 'No message provided' }}

<x-mail::button :url="'#'">
View Donations
</x-mail::button>

Thanks,<br>
**Rapid Tanzania Website**

</x-mail::message>
