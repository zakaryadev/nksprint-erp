@extends('layouts.main')

@section('title', 'Редактировать дизайнера')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('designers.update', ['designer' => $designer->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="last_name">Фамилия</label>
                                <input class="form-control" type="text" id="last_name" name="last_name"
                                    value="{{ $designer->user->last_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="first_name">Имя</label>
                                <input class="form-control" type="text" id="first_name" name="first_name"
                                    value="{{ $designer->user->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_number">Телефон</label>
                                <input class="form-control" type="text" id="phone_number" name="phone_number"
                                    value="{{ $designer->user->phone_number }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Э-мейл</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ $designer->user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Пароль</label>
                                <input class="form-control" type="text" id="password" name="password"
                                    value="{{ $designer->user->password }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="salary">Оклад</label>
                                <input class="form-control" type="text" id="salary" name="salary"
                                    value="{{ $designer->salary }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="procent">Процент</label>
                                <input class="form-control" type="text" id="procent" name="procent"
                                    value="{{ $designer->procent }}">
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
