@extends('layouts.main')

@section('title', 'Редактировать группы')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('master-groups.update', ['master_group' => $masterGroup->id]) }}"
                            method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="name">Название группы</label>
                                <input class="form-control" type="text" id="name" name="name"
                                    value="{{ $masterGroup->name }}">
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-save"></i>
                                Сохранить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
