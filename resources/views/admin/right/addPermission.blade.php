@extends("layouts.admin")
@section("content")
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold">
            TẠO DỮ LIỆU CHO BẢNG QUYỀN(PERMISSION)
        </div>
        <div class="card-body">
            @if (Session::has('status'))
            <div class="alert alert-success">
                {{Session::get('status')}}
            </div>
            @endif
           
            <form action="{{route('admin.right.create')}}" method="post">
                @csrf
                <div class="form-group w-100">
                    <label for="chooseModule">Chọn module</label>
                    <select name="moduleName" class="form-control" id="chooseModule">
                        <option value="">Chọn danh mục</option>
                        @foreach ($listModulNames as $item)
                            <option value="{{$item}}">{{$item}}</option>
                        @endforeach
                    </select>
                    @error('moduleName')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group w-100">
                            {{-- <label for="">Chọn module</label> --}}
                            {{-- <select name="postcat_id" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                            </select> --}}
                            <input type="checkbox" name="list" value="{{Auth::user()->id}}" id='list'>
                            <label for="list">List</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                            {{-- <label for="">Chọn module</label> --}}
                            {{-- <select name="postcat_id" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                            </select> --}}
                            <input type="checkbox" name="add" value="{{Auth::user()->id}}" id='add'>
                            <label for="add">Add</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                            {{-- <label for="">Chọn module</label> --}}
                            {{-- <select name="postcat_id" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                            </select> --}}
                            <input type="checkbox" name="edit" value="{{Auth::user()->id}}" id='edit'>
                            <label for="edit">Edit</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                            {{-- <label for="">Chọn module</label> --}}
                            {{-- <select name="postcat_id" class="form-control" id="">
                                <option value="">Chọn danh mục</option>
                            </select> --}}
                            <input type="checkbox" name="delete" value="{{Auth::user()->id}}" id='delete'>
                            <label for="delete">Delete</label>   
                        </div>
                    </div>
                </div>
                <button type="submit" name="btn-add" value="add new" class="d-block btn btn-primary">Thêm mới</button>

            </form>

           

            {{-- <div class="form-group w-100">
                <div class="form-group">
                    <label for="content">Mô tả quyền</label>
                    <textarea id="editer" name="productShortDesc" class="form-control" id="content" cols="30"
                        rows="5">{{old('productShortDesc')}}</textarea>
                    @error('productShortDesc')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div> --}}


        </div>
    </div>
    @endsection