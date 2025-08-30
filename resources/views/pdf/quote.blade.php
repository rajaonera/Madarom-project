
<h2>Devis #{{ $quoteRequest->id }}</h2>
<p>Date : {{ now()->format('d/m/Y') }}</p>
<p>Client : {{ $quoteRequest->user->name }}</p>

<table style="width:100%; border-collapse: collapse;" border="1">
    <thead>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix unitaire</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    @php $total = 0; @endphp
    @foreach ($quoteRequest->items as $item)
        @php
            $price = $item->product->activePrice?->amount ?? 0;
            $subtotal = $item->quantity * $price;
            $total += $subtotal;
        @endphp
        <tr>
            <td>{{ $item->product->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($price, 0, ',', ' ') }} Ar</td>
            <td>{{ number_format($subtotal, 0, ',', ' ') }} Ar</td>
        </tr>
    @endforeach
    </tbody>
</table>

<h4>Total général : {{ number_format($total, 0, ',', ' ') }} Ar</h4>
