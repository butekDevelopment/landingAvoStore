@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col-md-5 text-left">
                        <h4 class="text-dark">Category Product</h4>
                    </div>
                    <div class="col-md-5 text-right">
                        <button type="button" class="btn btn-outline-info create" data-target="#modalCreate"> <i
                                class="fa fa-plus" aria-hidden="true"></i> Add Category</button>
                    </div>
                </div>
            </div>
            <!-- Main row -->
            <div class="row justify-content-center">
                <div class="col-md-10">
                    @if(session()->get('failed'))
                        <div class="alert alert-warning alert-dismissible fade show">
                            {{ session()->get('failed') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                    @if(session()->get('success'))
                        <div class="alert alert-success alert-dismissible fade show" style="">
                            {{ session()->get('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-warning card-outline">
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Name Category</th>
                                        <th class="text-right">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach($category as $item)
                                    <tr>
                                        <td>{{ $item->name_category }}</td>
                                        <td class="text-right">
                                            <button type="button" class="btn btn-info edit"
                                                data-id="{{ $item->idcategory }}"
                                                data-name="{{ $item->name_category }}" data-target="#modalEdit">
                                                <i class="fas fa-pencil-alt"></i>
                                                Edit
                                            </button>
                                            <button type="button" class="btn btn-danger delete"
                                                data-id="{{ $item->idcategory }}"
                                                data-name="{{ $item->name_category }}" data-target="#modalDelete">
                                                <i class="fas fa-trash"></i>
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @if(count($category) == 0)
                            <div class="row justify-content-center">
                                <div class="col-md-4 alert alert-light text-center mt-1" role="alert">
                                    Nothing data to show
                                </div>
                            </div>
                        @endif
                    </div>
                    {{ $category->links() }}
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalEdit">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/category/update') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="id">Id Cotegory Product</label>
                                <input type="text" class="form-control" id="id" name="id" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Name Category Product</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <div class="col px-5">
                                <button type="submit" class="btn btn-info btn-block">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCreate">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/category/create') }}"
                            method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name Category Product</label>
                                <input type="text" class="form-control" id="name" name="name">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalDelete">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete Event Sale</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center">You want remove this event</p>
                        <p class="text-center" style="font-size: 20px">
                            <b class="productDelete"></b>
                        </p>
                        <p class="text-center mb-0" style="color: #868686; font-size: 14px"><i>Remove category product can be to
                                remove product and product discount</i></p>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <a type="button" class="btn btn-danger btn-block deleteYes" href="">Delete</a>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary btn-block" data-dismiss="modal"
                                    aria-label="Close">Batal</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
    @endsection

    @section('Js')
    <script type="text/javascript">
        $('.edit').click(function () {
            $('#modalEdit').modal();
            $('#id').val($(this).attr('data-id'));
            $('#name').val($(this).attr('data-name'));
        })

        $('.create').click(function () {
            $('#modalCreate').modal();
        })

        $('.delete').click(function () {
            $('#modalDelete').modal()
            $('.productDelete').text($(this).attr('data-name'));
            var idDelete = $(this).attr('data-id')
            console.log(idDelete)
            $('.deleteYes').attr('href', "/admin/category/delete/" + idDelete)
        })
    </script>
    @endsection