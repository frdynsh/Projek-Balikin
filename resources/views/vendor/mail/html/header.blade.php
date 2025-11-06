@props(['url'])
<tr>
<td class="header">
<a href="{{ $url ?? url('/') }}" style="display: inline-block;">
    <img src="{{ asset('images/icon/logo.png') }}" alt="{{ config('app.name') }}" style="max-width: 150px; height: auto;">
</a>
</td>
</tr>
