@extends('admin.layouts.dashboard')
@section('title', 'Добавление категории ')
@section('content')
    <form method="POST" action="{{ route('admin.category.save') }}" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <div class="md-form">
            <label for="title" class="title-info">Заголовок</label>
            <input type="text" id="title" name="title" class="form-control" value="">
        </div>

        <select name="parent_id" class="mdb-select md-form">
            <option value="" disabled selected>Выберите родительскую категорию</option>
            <option value="0">Убрать родительскую категорию</option>
            @foreach($allCategory as $key => $value)
                    <option value="{{$value->id}}">{{$value->title}}</option>
            @endforeach
        </select>
        <div class="md-form">
            <textarea id="description" name="description" class="md-textarea form-control"
                      rows="10"></textarea>
        </div>
        @endsection
        @section('footer')
            <button class="btn btn-success btn-rounded" type="submit">Сохранить</button>
            <button class="btn btn-danger btn-rounded" type="button"
                    onclick="window.location='{{ route('admin.category') }}'">Отменить
            </button>
    </form>
@endsection
