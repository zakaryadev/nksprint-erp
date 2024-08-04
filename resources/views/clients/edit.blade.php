@extends('layouts.main')

@section('title', 'Редактирование клиента')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title
						">Редактирование клиента</h4>
                    <form action="{{ route('clients.update', $client) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="first_name" class="form-label">Имя</label>
                            <input type="text" class="form-control" id="first_name" name="first_name"
                                value="{{ $client->first_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="last_name" class="form-label">Фамилия</label>
                            <input type="text" class="form-control" id="last_name" name="last_name"
                                value="{{ $client->last_name }}">
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Телефон</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number"
                                value="{{ $client->phone_number }}">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $client->email }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Адрес</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $client->address }}">
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Организация</label>
                            <input type="text" class="form-control" id="company_name" name="company_name"
                                value="{{ $client->company_name }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
