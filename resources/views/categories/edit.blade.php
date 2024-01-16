@section('content')
    @extends('layouts.app')
    <form method="POST" action="{{ route('category.update', $category['id']) }}">
        @csrf
        @method('PUT')
        <label for="category">Category:</label>
        <input type="text" name="category" value="{{ $category['category'] }}">
        <button class="bg-orange-500 m-3 py-1 px-3 rounded-sm uppercase text-white" type="submit">Save</button>
    </form>
@stop
