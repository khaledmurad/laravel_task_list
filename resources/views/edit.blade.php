@extends('layout.app')

@section('title', 'Create task')
@section('content')

    <form action="{{route('tasks.update', ['task'=>$task->id])}}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" value="{{$task->title}}" @class(['border-red-500' => $errors->has('title')])>
            @error('title')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="description">Description</label>
            <textarea name="description" id="description" rows="5" @class(['border-red-500' => $errors->has('description')])>{{$task->description}}</textarea>
            @error('description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label for="long_description">Long Description</label>
            <textarea name="long_description" id="long_description" rows="5" @class(['border-red-500' => $errors->has('long_description')])>{{$task->long_description}}</textarea>
            @error('long_description')
                <p class="error">{{$message}}</p>
            @enderror
        </div>

        <div class="flex items-center gap-2">
            <button type="submit" class="btn">Update</button>
            <a href="{{route('tasks.show',['task'=>$task])}}" class="btn">Cancel</a>
        </div>
    </form>

@endsection
