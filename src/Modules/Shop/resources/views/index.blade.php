<x-shop::layouts.master>
    <h1>Hello World</h1>

    <p>Module: {!! config('shop.name') !!}</p>

    @foreach ($shop as $item)
        {{ $item }}
    @endforeach
</x-shop::layouts.master>
