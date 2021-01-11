@extends('backend.layouts.app')

@section('title','Bai viet')

@section('main')


<div style="padding: 20px" >
    <table id="myTable" class="table table-hover">
        @include('errors.note')
        <thead class="thead-dark">
        <tr role="row">
            <th style="text-align: center">ID</th>
            <th>Ảnh</th>
            <th style="min-width: 110px">Ten nguoi dang</th>
            <th >Tiêu đề bài viết</th>
            <th style="min-width: 95px">Loại bài viết</th>
            <th >Mo ta</th>
            <th style="min-width: 100px;text-align:center">Ngày đăng</th>

            <th style="min-width:60px; text-align:center">Status</th>
            <th style="width: 70px;text-align:center">Hot</th>
            <th style="min-width: 55px">Options</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr>
                <th style="text-align: center">{{$item->id}}</th>
                <td><img style="width: 80px; height:80px; border-radius:50%" src="{{asset('upload/'.$item->users->first()->profile->image)}}" alt=""></td>
                <th>{{ $item->users->first()->name }}</th>
                <th>{{$item->title}}</th>
                <td>
                    @if($item->type==1)bai viet
                    @else Nhap @endif
                </td>
                <td>{{ $item->description }}</td>
                <td style="text-align: center">
                    {{date_format($item->created_at, 'Y-m-d H:m:s')}}
                </td>

                <td style="text-align: center;font-size:20px">
                    <form action="{{ route('admin.posts.status',$item->id) }}" method="POST">
                        @csrf
                        <input hidden @if($item->status==1) checked @endif type="checkbox" id="status" name="status" value="1">
                        <button style="border: none; outline:none" type="submit">
                            @if($item->status==1)<i class="fas fa-eye"></i>
                            @else <i class="fas fa-eye-slash"></i> @endif
                        </button>
                    </form>
                </td>
                <td style="text-align: center;font-size:20px">
                    <form action="{{ route('admin.posts.status2',$item->id) }}" method="POST">
                        @csrf
                        <input hidden @if($item->status2==1) checked @endif type="checkbox" id="status2" name="status2" value="1">
                        <button style="border: none; outline:none" type="submit">
                            @if($item->status2==1)<i class="fas fa-eye"></i>
                            @else <i class="fas fa-eye-slash"></i> @endif
                        </button>
                    </form>
                </td>
                <td>
                    <a class="btn btn-success" href="{{ route('admin.posts.edit',$item->id) }}"><i class="fas fa-edit"></i>Sửa</a>
                    <span class="btn btn-danger" data-toggle="modal" data-target="{{'#exampleModal'.$item->id}}">
                    <i class="fa fa-fw fa-trash"></i>Xóa
                    </span>
                    <div class="modal fade" id="{{'exampleModal'.$item->id}}" tabindex="-1" role="dialog" aria-labelledby="{{'exampleModalLabel'.$item->id}}" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="{{'exampleModalLabel'.$item->id}}">Thông báo</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                            <div class="modal-body">
                            Bạn chắc chắn muốn xóa?
                            </div>
                            <div class="modal-footer">
                                <form action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            </div>
                        </div>
                        </div>
                    </div>
                </td>
            </tr>

            @endforeach
        </tbody>
    </table>
</div>


@endsection
