

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
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Birthday</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($users as $user)

                                    <tr>

                                        <td>{{$i++}}</td>
                                        <td>{{$user->firstname}} {{$user->lastname}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{date('F')}} {{$user->b_date}}</td>

                                        <td>   <a href="mailto:{{$user->email}}" class="btn btn-primary btn-sm"><i class="fa fa-envelope-o "></i> Message </a>

                                        </td>

                                    </tr>
                                    @endforeach



                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <th>Phone number</th>
                                        <th>Birthday</th>
                                        <th>Action</th>
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
