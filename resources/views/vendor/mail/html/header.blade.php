@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('assets/neon_tranp_white.png') }}" width="180" class="logo" alt="Laravel Logo">
@else
<img src="{{ asset('assets/neon_tranp_white.png') }}" width="180" class="logo" alt="Laravel Logo">
@endif
</a>
</td>
</tr>