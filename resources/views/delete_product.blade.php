@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (Auth::user()->role_id == 'kantin')
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="col-3">
                <div class="card">
                    <div class="card-header">
                        Menu
                    </div>
                    <div class="card-body">
                        @include('components.sidebar_kantin')
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="card">
                    <div class="card-header">
                        Delete Product
                    </div>
                    <div class="card-body">
                        <form action="{{ route('product.deleteProductCard') }}" method="POST">
                            @csrf
                            <label for="">Pilih product</label>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <select name="product_id" class="form-select" id="">
                                            <option value="">-- Pilih Opsi --</option>
                                            @foreach ($products as  $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Pilih</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        @if ($product != '')
                        Apakah anda yakin ingin menghapus produk ini?
                        <div class="card mb-3">
                            <div class="card-header bg-success">
                                {{$product->name}}
                            </div>
                            <div class="card-body text-center" style="font-size: 15px">
                                <img src="images/{{$product->photo}}" alt="" width="200" height="200" class="mb-2">
                                {{-- <img src="https://source.unsplash.com/150x150/?esteh" alt=""> --}}
                                <div>{{$product->description}}</div>
                                <div>Harga: {{ $product->price }}</div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col">
                                        <form action="{{ route('product.destroy') }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn btn-sm btn-success">Yes</button>
                                        </form>
                                    </div>
                                    <div class="col text-end">
                                        <a href="" class="btn btn-sm btn-danger">No</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
