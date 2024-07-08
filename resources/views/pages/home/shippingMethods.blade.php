@if($shippingMethods && !$shippingMethods->isEmpty())
    @foreach($shippingMethods as $shippingMethod)
    <div class="form-check">
        <label>
            <input type="radio" class="form-check-input" name="shippingMethod" value="{{ $shippingMethod->id }}" @if($loop->first) checked @endif required> {{ $shippingMethod->name }}
        </label>
    </div>
    @endforeach
@else
<p>Ehhez az országhoz nem tartoznak szállítási módok!</p>
@endif