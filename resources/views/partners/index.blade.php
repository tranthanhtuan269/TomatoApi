@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-sm-12"><h2 class="text-center">DSC Administrator</h2><a class="btn btn-default logout" href="{{ url('logout') }}">Logout</a></div>
    <div class="clearfix"></div>
    <div class="col-sm-3">
        @component('components.menuleft', ['active' => 'partners'])
        @endcomponent
    </div>
    <div class="col-sm-9"> 
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Danh sách đối tác <a href="{{ url('/') }}/partners/create" class="pull-right"><i class="fas fa-plus"></i> Thêm đối tác</a> </h3>
            </div>
            <div class="panel-body">
            	<table class="table table-striped">
                            <thead> 
                                <tr> 
                                    <th>#</th> 
                                    <th>Tên đối tác</th> 
                                    <th>Số điện thoại</th> 
                                    <th>Email</th> 
                                    <th>Trạng thái</th> 
                                </tr> 
                            </thead>
                            <tbody> 
                                @foreach($partners as $partner)
                                <tr> 
                                    <th scope="row">{{ $partner->id }}</th> 
                                    <td>{{ $partner->name }}</td> 
                                    <td>{{ $partner->phone }}</td> 
                                    <td>{{ $partner->email }}</td> 
                                    <td class="group-control">
                                        <a href="{{ url('/') }}/partners/{{ $partner->id }}/edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ url('partners/'.$partner->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}

                                            <button type="submit" class="delete-btn">
                                                            <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td> 
                                </tr>
                                @endforeach
                            </tbody>
                       </table>
            </div>
        </div>
    </div>
</div>
@endsection