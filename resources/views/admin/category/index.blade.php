@extends('admin.layouts.dashboard')
@section('title', 'Список всех категорий')
@section('content')
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
            </tr>
            </thead>
            <tbody>
            @foreach($category as $cat)
                    <tr>
                        <td>{{$cat->id}}</td>
                        <td><a href="{{route('admin.anime.edit', $cat->url)}}">{{$cat->title}}</a></td>
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
