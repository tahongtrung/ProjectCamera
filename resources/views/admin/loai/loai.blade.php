@extends('admin.index')
@section('content')
<div style="text-align:center" id="quanly">
    <table width="100%"  cellspacing="0" cellpadding="0">
        <th>STT</th>
        <th>Tên loại</th>
        <th colspan="2"><div class="btn_them"><a href="{{route('themloai')}}"><i class="fa fa-plus-circle" aria-hidden="true"></i> &nbspThêm</a></div></th>
        @foreach($ds_loai as $loai)
            <tr>
                <td>{{$stt = $stt + 1}}</td>
                <td align="center">{{$loai->TenLoai}}</td>
                <td>
                    <div class="btn_xoa">
                        <a href="xoa-loai/{{$loai->idLoai}}" onclick="return confirm('Bạn có chắc chắn muốn xóa không?');"><i class="fa fa-trash-o" aria-hidden="true"></i> &nbspXóa
                        </a>
                    </div>
                </td>
                <td>
                    <div class="btn_sua">
                        <a href=""><i class="fa fa-pencil-square-o" aria-hidden="true"></i>&nbspSửa
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
    </table>
</div>
@endsection