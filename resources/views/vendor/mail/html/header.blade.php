@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://images.vexels.com/media/users/3/146229/isolated/preview/1b38ca1eeff0ab0e30a2281b58ee929a-silueta-de-vuelo-de-avion-simple.png" class="logo" alt="HotelesHB Logo">
{{ config('app.name', 'HotelesHB') }}
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
