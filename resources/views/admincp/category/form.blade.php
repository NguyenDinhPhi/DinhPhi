@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Quan ly danh muc</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(!isset($category))
                        {!! Form::open(['route' => 'category.store', 'method' => 'POST']) !!}
                    @else
                        {!! Form::open(['route' =>['category.update',$category->id], 'method' => 'PUT']) !!}   
                    @endif
                        <div class="form-group">
                            {!! Form::label('title', 'Title', []) !!}
                            {!! Form::text('title', isset($category) ? $category->title : '', 
                            ['class' => 'form-control','placeholder' => 'nhap du lieu...','id' => 'slug','onkeyup'=>'ChangeToSlug()']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('slug', 'Slug', []) !!}
                            {!! Form::text('slug', isset($category) ? $category->slug : '', 
                            ['class' => 'form-control','placeholder' => 'nhap du lieu...','id' => 'convert_slug']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('description', 'Description', []) !!}
                            {!! Form::textarea('description', isset($category) ? $category->description: '', ['style'=>'resize:none','class' => 'form-control','placeholder' => 'nhap du lieu...','id' => 'description']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('Active', 'Active', []) !!}
                            {!! Form::select('status' ,['1' => 'Hi???n th???','0' => 'Kh??ng' ],isset($category) ? $category->status : '',['class' => 'form-control']) !!}
                        </div>
                    @if(!isset($category))
                        {!! Form::submit('th??m d??? li???u', ['class' =>'btn btn-success']) !!}
                    @else
                        {!! Form::submit('C???p nh???t', ['class' =>'btn btn-success']) !!}
                    @endif
                        {!! Form::close() !!}
                </div>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Slug</th>
                    <th scope="col">Active/Inactive</th>
                    <th scope="col">Manager</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($list as $key => $cate)
                    <tr>
                        <th scope="row">{{$key}}</th>
                        <td>{{$cate->title}}</td>
                        <td>{{$cate->description}}</td>
                        <td>{{$cate->slug}}</td>
                        <td>
                            @if($cate->status)
                                Hi???n th???
                            @else
                                Kh??ng hi???n th???
                            @endif
                        </td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['category.destroy',$cate ->id],'onsubmit'=>'return confirm("b???n c?? mu???n xo?? kh??ng ?")']) !!}
	                        {!! Form::submit('Xo??', ['class'=>'btn btn-danger']) !!}
                            {!! Form::close() !!}
                            <a href="{{route('category.edit',$cate->id)}}" class="btn btn-warning">S???a</a>

                        </td>
                      </tr>  
                    @endforeach
                  
                  
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
