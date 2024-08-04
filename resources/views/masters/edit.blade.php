@extends('layouts.main')

@section('title', 'Редактировать мастера')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('masters.update', ['master' => $master->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label" for="last_name">Фамилия</label>
                                <input class="form-control" type="text" id="last_name" name="last_name"
                                    value="{{ $master->user->last_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="first_name">Имя</label>
                                <input class="form-control" type="text" id="first_name" name="first_name"
                                    value="{{ $master->user->first_name }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="phone_number">Телефон</label>
                                <input class="form-control" type="text" id="phone_number" name="phone_number"
                                    value="{{ $master->user->phone_number }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">Э-мейл</label>
                                <input class="form-control" type="email" id="email" name="email"
                                    value="{{ $master->user->email }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="password">Пароль</label>
                                <input class="form-control" type="text" id="password" name="password"
                                    value="{{ $master->user->password }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="salary">Оклад</label>
                                <input class="form-control" type="text" id="salary" name="salary"
                                    value="{{ $master->salary }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="procent">Процент</label>
                                <input class="form-control" type="text" id="procent" name="procent"
                                    value="{{ $master->procent }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="masters_group">Группа мастеров</label>
                                <select class="form-select" id="masters_group" name="masters_group_id">
                                    @foreach ($masterGroups as $masterGroup)
                                        <option value="{{ $masterGroup->id }}"
                                            @if ($masterGroup->id == $master->masters_group_id) selected @endif>{{ $masterGroup->name }}
                                        </option>
                                    @endforeach
                                </select>
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
