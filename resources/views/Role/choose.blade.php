@extends('Default.default')
@section('title','为用户选择角色')
    @section('content')
        <form action="">
            @foreach($roles as $role)
            <label class="checkbox-inline">
                <input type="checkbox" id="{{$role->name}}" name="{{$role->name}}" value="option1"> {{$role->display_name}}
            </label>
                @endforeach
        </form>
        @stop