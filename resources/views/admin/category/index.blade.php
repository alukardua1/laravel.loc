@extends('admin.layouts.dashboard')
@section('title', 'Список всех категорий')
@section('content')
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td><a href="{{route('admin.category.edit', $cat->url)}}">{{$cat->title}}</a></td>
                        <td><a href="{{route('admin.category.delete', $cat->url)}}" aria-label="Удалить"><i class="fas fa-trash-alt"></i></a> </td>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer')
    <!--Pagination-->
    @if($category->total() > $category->count())
        {{ $category->links() }}
    @endif
    <!--Pagination-->
@endsection
