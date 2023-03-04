@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <h1 class="m-0 text-dark">Promotion Content</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-info card-outline">
                        <div class="card-body">
                            @if(session()->get('failed upload'))
                                <div class="alert alert-warning alert-dismissible fade show">
                                    {{ session()->get('failed upload') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if(session()->get('success'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    {{ session()->get('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form role="form" action="{{ url('/admin/promotionContent/banner') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Status text banner</label>
                                    <select class="form-control" id="statusBanner" name="statusBanner">
                                        <option value="1"
                                        {{ $status == 1 ? 'selected' : null }}>
                                        True</option>
                                    <option value="0"
                                        {{ $status == 1 ? null : 'selected' }}>
                                        False</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="titleBanner">Title Banner</label>
                                    <input type="text" class="form-control" value="{{ $title }}" id="titleBanner"
                                        name="titleBanner" placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="subTitleBanner">Subtitle Banner</label>
                                    <input type="text" class="form-control" value="{{ $subTitle }}"
                                        id="subTitleBanner" name="subTitleBanner" placeholder="Subtitle">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">Image Banner</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="inputBannerImg"
                                                name="fileName">
                                            <label class="custom-file-label" for="inputBannerImg">Choose
                                                file</label>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @endsection

    @section('Js')
    <script>
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    @endsection