

@extends('layouts.admin')


@section('content')


        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    @include('includes.admin.alerts')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">


                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th width="5%">S/N</th>
                                        <th width="15%">Name</th>
                                        <th width="20%">Email</th>
                                        <th width="15%">Phone Number</th>

                                        <th width="15%">Reg. Date</th>
                                        <th width="30%">Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)
                                    <tr>

                                        <td>{{$i++}}</td>
                                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>

                                        <td>{{  date('j \\ F Y', strtotime($user->created_at)) }}</td>
                                        <td class="project-actions">
                                            <form action="{{ route('users.destroy',$user->id) }}" method="POST">
                                                <a class="btn btn-sm btn-info " href="{{ route('users.show',$user->username) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                               @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th >S/N</th>
                                        <th >Name</th>
                                        <th >Email</th>
                                        <th >Phone Number</th>

                                        <th >Reg. Date</th>
                                        <th >Action</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->

                </div>
                <!-- /.row -->
                    </div>
                </div>
            </div>
                    <!-- /.container-fluid -->
        </section>


    <!-- /.content-wrapper -->


    @include('includes.admin.data')
@endsection
