@extends('admin.layouts.dashboard')
@section('title', 'Список всех новостей')
@section('content')
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
            <tr>
                <th>#</th>
                <th>Название</th>
                <th>Категория</th>
                <th>Автор</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($animePost as $post)
                @if($post->posted_at === '1')
                    <tr>
                @else
                    <tr class="alert alert-danger" role="alert">
                        @endif
                        <td>{{$post->id}}</td>
                        <td><a href="{{route('admin.anime.edit', $post->id)}}">{{$post->title}}</a></td>
                        <td>
                            @foreach($post->getCategory as $category)
                                @if ($loop->last) {{ $category->title }} @else
                                    {{ $category->title }} ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{$post->getUser->login}}</td>
                        <td><a href="{{route('admin.anime.delete', $post->id)}}" aria-label="Удалить"><i class="fas fa-trash-alt"></i></a> </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer')
    <!--Pagination-->
    @if($animePost->total() > $animePost->count())
        {{ $animePost->links() }}
    @endif
    <!--Pagination-->
@endsection
