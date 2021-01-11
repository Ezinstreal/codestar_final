@extends('backend.layouts.app')

@section('title','Admin')

@section('main')

<div style="padding: 20px">
    <table id="myTable" class="table" style="padding: 20px">
        <thead class="thead-dark">
            @include('errors.note')
          <tr role="row">
            <th scope="col">STT</th>
            <th scope="col">Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Ngay tao</th>
            <th scope="col">Sửa mật khẩu</th>
            <th scope="col">Quyền</>
            <th scope="col" style="width: 180px; text-align:center">Options</th>
          </tr>
        </thead>
        <tbody>
            @foreach($users as $key => $item)

            @if ($item->id != 1 )
                <tr>
                    <th scope="row">{{$key}}</th>
                    <td>{{$item->name}} </td>
                    <td>{{$item->email}}</td>
                    <td>
                        {{date_format($item->created_at, 'Y-m-d H:m:s')}}
                    </td>
                    <td>
                        <span class="btn btn-success" data-toggle="modal" data-target="{{'#exampleModal2'.$item->id}}">
                            <i class="fas fa-edit"></i>Sửa
                        </span>
                            <div class="modal fade" id="{{'exampleModal2'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'exampleModal2Label'.$item->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="{{'exampleModal2Label'.$item->id}}">Sửa mật khẩu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                        <form action="{{route('admin.user.password',$item->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Mật khẩu mới</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="password" name="password" class="form-control" placeholder="Nhập mật khẩu mới" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="">Nhập lại mật khẩu</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="form-group">
                                                            <input type="password" name="cf_password" class="form-control" placeholder="Nhập lại mật khẩu" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Sửa</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                    </td>
                    <td>
                        {{-- {{ implode($item->roles()->get()->pluck('name')->toArray()) }} --}}
                        @foreach ($item->roles as $role)
                            {{ $role->name }}
                        @endforeach
                    </td>
                    <td>
                        @can('edit-users')
                        <a href="{{ route('admin.user.edit',$item->id) }}" type="button" class="btn btn-success float-left">
                        <i class="fas fa-edit"></i>Sửa</a>
                        @endcan
                        @can('role-admin')
                        <form action="{{  route('admin.user.destroy',$item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><i class="fa fa-fw fa-trash"></i>Xóa</button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endif
          @endforeach
        </tbody>
    </table>
</div>

@endsection
