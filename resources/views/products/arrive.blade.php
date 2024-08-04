@extends('layouts.main')

@section('title', 'Поступление товара')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.storeArrive', $product->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Количество</label>
                            <input type="text" class="form-control" id="quantity" name="quantity">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Цена</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price"
                                value="{{ $product->unit_price }}">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Ед-измер</label>
                            <select class="form-select" id="unit" name="unit_id" aria-readonly="true">
                                <option value="{{ $product->unit->id }}">{{ $product->unit->name }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="provider" class="form-label">Поставщик</label>
                            <select class="form-select" id="provider" name="provider_id">
                                @foreach ($providers as $provider)
                                    <option value="{{ $provider->id }}">{{ $provider->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Поступить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
