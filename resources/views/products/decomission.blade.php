@extends('layouts.main')

@section('title', 'Списание товара')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('products.storeDecomission', $product->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Название</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $product->name }}" readonly>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="date" class="form-label">Ед-измер</label>
                                    <select class="form-select" id="unit" name="unit_id" aria-readonly="true">
                                        <option value="{{ $product->unit->id }}">{{ $product->unit->name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Цена</label>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price"
                                        value="{{ $product->unit_price }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="quantity" class="form-label">Количество</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity">
                                    <div id="quantityHelp" class="form-text text-muted">
                                        В наличии:
                                        <span class="badge badge-soft-primary font-size-14">{{ $product->quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="provider" class="form-label">Описание</label>
                            <textarea class="form-control" id="desc" name="desc"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="provider" class="form-label">Общая цена</label>
                            <input type="text" class="form-control" id="total_price" value="" readonly>
                        </div>
                        <div class="button-items">
                            <button onclick="total()" type="button" class="btn btn-primary">
                                Подсчитать
                            </button>
                            <button type="submit" class="btn btn-danger ml-5">
                                Списать
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/assets/libs/jszip/jszip.min.js"></script>
    <script>
        function formatNumber(num, decimals) {
            return num.toLocaleString('en-US', {
                minimumFractionDigits: decimals,
                maximumFractionDigits: decimals
            });
        }

        function total() {
            var this_summa = 0;
            var total = 0;
            var count = 0;
            $('#save_btn').prop('disabled', false);
            var q = $('#quantity').val();
            var up = $('#unit_price').val();
            var tp = $('#total_price').val();
            if (q == '' || up == '') {
                $('#total_price').val('');
                return;
            }
            this_summa = q * up;
            $('#total_price').val(formatNumber(this_summa));
        }
    </script>

@endsection
