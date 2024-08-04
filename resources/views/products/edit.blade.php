@extends('layouts.main')

@section('title', 'Редактировать товар')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $product->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Описание</label>
                            <textarea class="form-control" id="desc" name="desc" rows="3">{{ $product->desc }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Единица измерения</label>
                            <select class="form-select" id="unit_id" name="unit_id">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}" @if ($unit->id == $product->unit_id) selected @endif>
                                        {{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- <div class="mb-3">
                            <label for="unit_price" class="form-label">Цена единицы</label>
                            <input type="text" class="form-control" id="unit_price" name="unit_price"
                                value="{{ $product->unit_price }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="quantity" class="form-label">Количество</label>
                            <input type="text" class="form-control" id="quantity" name="quantity"
                                value="{{ $product->quantity }}" disabled>
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline-block">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">
                <i class="bx bx bxs-trash"></i>
            </button>
        </form>
    @endsection
