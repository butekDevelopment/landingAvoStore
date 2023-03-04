@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-10">
                    <h1 class="m-0 text-dark">Home Content</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card card-info card-outline card-outline-tabs">
                        <div class="card-header p-0 border-bottom-0">
                            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                                        aria-selected="true">Banner 1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                                        href="#custom-tabs-four-profile" role="tab"
                                        aria-controls="custom-tabs-four-profile" aria-selected="false">Banner 2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                                        href="#custom-tabs-four-messages" role="tab"
                                        aria-controls="custom-tabs-four-messages" aria-selected="false">Banner 3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                                        href="#custom-tabs-four-settings" role="tab"
                                        aria-controls="custom-tabs-four-settings" aria-selected="false">Content
                                        About</a>
                                </li>
                            </ul>
                        </div>
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
                            <div class="tab-content" id="custom-tabs-four-tabContent">
                                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-home-tab">
                                    <form action="{{ url('/admin/banner/banner1') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Status text banner</label>
                                            <select class="form-control" id="statusBanner1" name="statusBanner">
                                                <option value="1"
                                                    {{ $status1 == 1 ? 'selected' : null }}>
                                                    True</option>
                                                <option value="0"
                                                    {{ $status1 == 1 ? null : 'selected' }}>
                                                    False</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="titleBanner1">Title Banner</label>
                                            <input type="text" class="form-control" value="{{ $title1 }}"
                                                id="titleBanner1" placeholder="Title" name="titleBanner">
                                        </div>
                                        <div class="form-group">
                                            <label for="subTitleBanner1">Subtitle Banner</label>
                                            <input type="text" class="form-control" value="{{ $subtitle1 }}"
                                                id="subTitleBanner1" placeholder="Subtitle" name="subTitleBanner">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile1">Image Banner</label>
                                            <div class="input-group">
                                                <div class="custom-file ">
                                                    <input type="file" class="custom-file-input" id="inputBannerImg1"
                                                        name="fileName">
                                                    <label class="custom-file-label" for="inputBannerImg1">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-profile-tab">
                                    <form role="form"
                                        action="{{ url('/admin/banner/banner2') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Status text banner</label>
                                            <select class="form-control" id="statusBanner2" name="statusBanner">
                                                <option value="1"
                                                    {{ $status2 = 1 ? "selected" : "" }}>
                                                    True</option>
                                                <option value="0"
                                                    {{ $status2 = 1 ? "" : "selected" }}>
                                                    False</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="titleBanner2">Title Banner</label>
                                            <input type="text" class="form-control" value="{{ $title2 }}"
                                                id="titleBanner2" name="titleBanner" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="subTitleBanner2">Subtitle Banner</label>
                                            <input type="text" class="form-control" value="{{ $subtitle2 }}"
                                                id="subTitleBanner2" name="subTitleBanner" placeholder="Subtitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile2">Image Banner</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputBannerImg2"
                                                        name="fileName">
                                                    <label class="custom-file-label" for="inputBannerImg2">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-messages-tab">
                                    <form role="form"
                                        action="{{ url('/admin/banner/banner3') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label>Status text banner</label>
                                            <select class="form-control" id="statusBanner3" name="statusBanner">
                                                <option value="1"
                                                    {{ $status3 = 1 ? "selected" : "" }}>
                                                    True</option>
                                                <option value="0"
                                                    {{ $status3 = 1 ? "" : "selected" }}>
                                                    False</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="titleBanner3">Title Banner</label>
                                            <input type="text" class="form-control" value="{{ $title3 }}"
                                                id="titleBanner3" name="titleBanner" placeholder="Title">
                                        </div>
                                        <div class="form-group">
                                            <label for="subTitleBanner3">Subtitle Banner</label>
                                            <input type="text" class="form-control" value="{{ $subtitle3 }}"
                                                id="subTitleBanner3" name="subTitleBanner" placeholder="Subtitle">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleInputFile3">Image Banner</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="inputBannerImg3"
                                                        name="fileName">
                                                    <label class="custom-file-label" for="inputBannerImg3">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                                    aria-labelledby="custom-tabs-four-settings-tab">
                                    <form role="form" action="{{ url('/admin/content/edit') }}"
                                        method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label for="exampleInputFile3">Image Logo</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="logoContent"
                                                        name="fileName">
                                                    <label class="custom-file-label" for="logoContent">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <label for="subTitleBanner3">Content About</label>
                                        <textarea class="textarea form-control" name="contentDescription"
                                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ $content_about }}</textarea>
                                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                                    </form>
                                </div>
                            </div>
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