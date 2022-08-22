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
            {!! Form::open(['url'=>route('admin.right.update',$rights[0]->id),'method'=>'post','files'=>true]) !!}
            @csrf


            <div class="form-group w-100">
                <label for="chooseModule">Tên quyền</label>
                <input type="text" name="nameOfRight" value="{{$rights[0]->nameOfRight}}" class="form-control" id="" placeholder="Tên quyền">
            </div>
            
            <div class="form-group w-100">
                <div class="form-group">
                    <label for="content">Mô tả quyền</label>
                    <textarea id="editer" name="descriptionOfRight" class="form-control" id="content" cols="30"
                        rows="5">{{$rights[0]->descriptionOfRight}}</textarea>
                    @error('productShortDesc')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
            </div>

            @foreach ($data as $item)
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group w-100 bg-primary p-2">
                            <input type="checkbox" disabled="disabled" id=''>
                            <label for="">{{$item->moduleName}}</label>   
                        </div>
                    </div>
                    <div class="col mt-2 mb-3">
                        <div class="form-group w-100 ml-2">
                            <input type="checkbox" name="{{$item->moduleName}}[list]" value="1" {{$item->list>0?'checked':""}} id='list'>
                            <label for="">List</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                
                            <input type="checkbox" name="{{$item->moduleName}}[add]" value="1" {{$item->add>0?'checked':""}} id='add'>
                            <label for="">Add</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                        
                            <input type="checkbox" name="{{$item->moduleName}}[edit]" value="1" {{$item->edit>0?'checked':""}} id='edit'>
                            <label for="">Edit</label>   
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group w-100">
                            
                            <input type="checkbox" name="{{$item->moduleName}}[delete]" value="1" {{$item->delete>0?'checked':""}} id='delete'>
                            <label for="">Delete</label>   
                        </div>
                    </div>
                </div>
            @endforeach
           


            {{-- <div class="row">
                <div class="col-md-12">
                    <div class="form-group w-100 bg-primary p-2">
                      
                        <input type="checkbox" disabled="disabled" id=''>
                        <label for="">Post</label>   
                    </div>
                </div>
                <div class="col mt-2 mb-3">
                    <div class="form-group w-100 ml-2">
                       
                        <input type="checkbox" name="listcheck[]" id='list1'>
                        <label for="list1">List</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                      
                        <input type="checkbox" name="listcheck[]" id='add1'>
                        <label for="add1">Add</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        
                        <input type="checkbox" name="listcheck[]" id='edit1'>
                        <label for="edit1">Edit</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='delete1'>
                        <label for="delete1">Delete</label>   
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group w-100 bg-primary p-2">
                      
                        <input type="checkbox" disabled="disabled" id=''>
                        <label for="">Product</label>   
                    </div>
                </div>
                <div class="col mt-2 mb-3">
                    <div class="form-group w-100 ml-2">
                        
                        <input type="checkbox" name="listcheck[]" id='list2'>
                        <label for="list2">List</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        
                        <input type="checkbox" name="listcheck[]" id='add2'>
                        <label for="add2">Add</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        
                        <input type="checkbox" name="listcheck[]" id='edit2'>
                        <label for="edit2">Edit</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        
                        <input type="checkbox" name="listcheck[]" id='delete2'>
                        <label for="delete2">Delete</label>   
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group w-100 bg-primary p-2">
                        
                        <input type="checkbox" disabled="disabled" id=''>
                        <label for="">Slide</label>   
                    </div>
                </div>
                <div class="col mt-2 mb-3">
                    <div class="form-group w-100 ml-2">
                        
                        <input type="checkbox" name="listcheck[]" id='list3'>
                        <label for="list3">List</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                        
                        <input type="checkbox" name="listcheck[]" id='add3'>
                        <label for="add3">Add</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='edit3'>
                        <label for="edit3">Edit</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='delete3'>
                        <label for="delete3">Delete</label>   
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group w-100 bg-primary p-2">
                      
                        <input type="checkbox" disabled="disabled" id=''>
                        <label for="">Order</label>   
                    </div>
                </div>
                <div class="col mt-2 mb-3">
                    <div class="form-group w-100 ml-2">
                       
                        <input type="checkbox" name="listcheck[]" id='list4'>
                        <label for="list4">List</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='add4'>
                        <label for="add4">Add</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='edit4'>
                        <label for="edit4">Edit</label>   
                    </div>
                </div>
                <div class="col">
                    <div class="form-group w-100">
                       
                        <input type="checkbox" name="listcheck[]" id='delete4'>
                        <label for="delete4">Delete</label>   
                    </div>
                </div>
            </div> --}}

        </div>
    </div>
    <button type="submit" name="btn-update" value="update" class="d-block btn btn-primary ml-3">Cập nhật</button>
    {!! Form::close() !!}
    @endsection