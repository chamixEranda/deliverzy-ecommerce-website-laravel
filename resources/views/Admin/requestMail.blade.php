@component('mail::message')

Dear Manager,<br>
    Please supply us with the following listed products.


@component('mail::table')
<table>
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Qty</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($maildata['product_name'] as $key => $product)
        <tr>
            <td>{{ $product }}</td>
            <td>{{ $maildata['qty'][$key] }} </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endcomponent
<h3>PO No: {{ $maildata['po_id'] }}</h3><br>
@if ($maildata['description'])
Description: <br>
{{ $maildata['description'] }}
@endif
<br>


Thanks,
{{ config('app.name') }}
@endcomponent