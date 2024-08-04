@extends('layouts.main')

@section('title', 'Изменение услуги')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Изменение услуги</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('services.update', $service->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Название</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ $service->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Стоимость</label>
                            <input type="text" class="form-control" id="price" name="price"
                                value="{{ $service->price }}">
                        </div>
                        <div class="mb-3">
                            <label for="unit_id" class="form-label">Единица измерения</label>
                            <select class="form-select" id="unit_id" name="unit_id">
                                @foreach ($units as $unit)
                                    <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="desc" class="form-label">Описание</label>
                            <textarea class="form-control" id="desc" name="desc">{{ $service->desc }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="bx bxs-save"></i>
                            Сохранить
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
