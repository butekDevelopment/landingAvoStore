@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content" style="margin-right: 0px !important; margin-left: 0px !important">
        <div class="container col-md-10">
            <div class="col">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col text-left">
                        <h4 class="text-dark">Event Promotion</h4>
                    </div>
                    @if(count($event) == 0)
                        <div class="col text-right">
                            <button type="button" class="btn btn-outline-info create" data-target="#modalCreate"
                                data-backdrop="static" data-keyboard="false"> <i class="fa fa-plus"
                                    aria-hidden="true"></i>&nbsp Add Promo</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col">
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
                    <div class="card card-info card-outline">
                        <div class="card-body p-0">
                            <table class="table projects">
                                <thead>
                                    <tr>
                                        <th>Title Sale</th>
                                        <th class="text-center">Start Event</th>
                                        <th class="text-center">End Event</th>
                                        <th>Status For Event</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event as $item)
                                        <tr>
                                            <td>{{ $item->name_event }}</td>
                                            <td class="text-center">
                                                {{ date('d F Y',strtotime($item->start_event)) }}
                                            </td>
                                            <td class="text-center">
                                                {{ date('d F Y',strtotime($item->end_event)) }}
                                            </td>
                                            <td>{{ $item->status == 1 ? "Ready" : "Not Ready" }}
                                            </td>
                                            <td class=" project-actions text-right">
                                                <button type="button" class="btn btn-success btn-sm view"
                                                    data-id="{{ $item->idevent }}" data-target="#modalView">
                                                    <i class="fas fa-book-open"></i> View
                                                </button>
                                                <a type="button" class="btn btn-info btn-sm"
                                                    href="{{ url("/admin/sale/edit/$item->idevent") }}">
                                                    <i class="fas fa-pencil-alt"></i> Edit
                                                </a>
                                                <button class="btn btn-danger btn-sm delete"
                                                    data-name="{{ $item->name_event }}"
                                                    data-id="{{ $item->idevent }}" data-target="#modalDelete">
                                                    <i class="fas fa-trash"></i> Delete
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if(count($event) == 0)
                            <div class="row justify-content-center">
                                <div class="col-md-4 alert alert-light text-center mt-1" role="alert">
                                    Nothing data to show
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalCreate">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form role="form" action="{{ url('/admin/sale/create') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="nameEvent">Name Event</label>
                                <input type="text" class="form-control nameEvent" name="nameEvent" required>
                            </div>
                            <div class="row">
                                <div class="col form-group">
                                    <label for="startEvent">Start Event</label>
                                    <input type="text" class="form-control" id='datepickerStart' name="dateStart"
                                        readonly="readonly" style="background-color: white !important;">
                                </div>
                                <div class="col form-group">
                                    <label for="endEvent">End Event</label>
                                    <input type='text' class="form-control" id='datepickerEnd' name="dateEnd"
                                        readonly="readonly" style="background-color: white !important;">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="statusEvent" class="mb-0">Status Ready</label>
                                <p style="font-size: 13px; color: #a7a7a7; margin-bottom: 10px !important">Status for
                                    event to ready</p>
                                <select class="form-control statusEvent" id="statusEvent" name="statusEvent" required>
                                    <option value="" selected hidden>Choose status for event</option>
                                    <option value="1">True</option>
                                    <option value="0">False</option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-3 text-center">
                                    <label for="discount" class="col-form-label">Discount</label>
                                    <hr class="my-0 mx-2">
                                    <div class="row text-center">
                                        <div class="col text-right mt-2">
                                            <button type="button" class="btn btn-primary" id="addNewDiscount">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                        <div class="col text-left mt-2">
                                            <button type="button" class="btn btn-danger" id="removeNewDiscount">
                                                <i class="fa fa-minus" aria-hidden="true" style="color: white"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col inputDiscount">
                                    <input type="number" maxlength="2" class="form-control" name="discount1" required
                                        oninput="this.value=this.value.slice(0,this.maxLength)"
                                        placeholder="Discount percent">
                                </div>
                            </div>
                            <div class="alert alert-warning fade show messageAdd text-center" style="display: none"></div>
                            <div class="mx-5">
                                <div class="loader" id="loader" style="display: none"></div>
                                <button type="submit" id="submitCreate" class="btn btn-info btn-block">Save</button>
                                <div id="messageError" class="text-center" style="display: none">
                                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal"
                                        aria-label="Close">
                                        Close
                                    </button>
                                    <p class="mb-0" style="color: #545454;">Some Event have already in status
                                        <i>Ready</i></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modalView">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">View Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nameEvent">Name Event</label>
                            <input type="text" class="form-control" id="nameEvent"
                                style="background-color: white !important" readonly>
                        </div>
                        <div class="row">
                            <div class="col form-group">
                                <label for="startEvent">Start Event</label>
                                <input type="text" class="form-control" id='datepickerStartView' readonly="readonly"
                                    style="background-color: white !important;">
                            </div>
                            <div class="col form-group">
                                <label for="endEvent">End Event</label>
                                <input type='text' class="form-control" id='datepickerEndView' readonly="readonly"
                                    style="background-color: white !important;">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-3 text-center align-self-center">
                                <label for="discount" class="col-form-label center">Discount</label>
                            </div>
                            <div class="col" id="inputDiscount">

                            </div>
                        </div>
                        <div class="col form-group">
                            <label for="statusEventView" class="">Status Ready</label>
                            <p style="font-size: 13px; color: #a7a7a7">Status for product to sale ready have discount
                            </p>
                            <input type='text' class="form-control statusEventView" id='statusEventView'
                                readonly="readonly" style="background-color: white !important;">
                        </div>
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
                        <p class="text-center mb-0" style="color: #a7a7a7; font-size: 14px"><i>Remove event can be to
                                remove discount and product have same event</i></p>
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
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script type="text/javascript">
        var int = 1;
        $('.create').click(function () {
            $('#modalCreate').modal({
                backdrop: 'static',
                keyboard: false
            });
        })

        $('.statusEvent').click(function () {
            var value = $('.statusEvent').val()
                dateStart = $('#datepickerStart').val()
                dateEnd = $('#datepickerEnd').val()
                dateNow = moment(new Date()).format('DD MMMM YYYY');
            if(value == 1){
                if(dateNow >= dateStart && dateNow <= dateEnd){
                    $('.messageAdd').text("")
                    $('.messageAdd').hide()
                }else{
                    $('.messageAdd').text("Status can't true because, date now not same for date start")
                    $('.messageAdd').show()
                    $('.statusEvent').val('')
                }
            }else{
                $('.messageAdd').text("")
                $('.messageAdd').hide()

            }
        })

        $('#modalCreate').on('hidden.bs.modal', function (e) {
            $('.nameEvent').val('')
            $('#datepickerStart').val('');
            $('#datepickerEnd').val('');
            $('#statusEvent').val('')
            $("#loader").hide()
            $('#submitCreate').show()
            $('#messageError').hide()
        })

        $(document).ready(function () {
            $('#datepickerStart').datepicker({
                format: 'dd MM yyyy',
                autoclose: true,
                startDate: "dateToday",
            }).on('change', function(){
                $('.statusEvent').val('')
                $('.messageAdd').text("")
                $('.messageAdd').hide()
                if($('#datepickerEnd').val() != ''){
                    var dateStart = $('#datepickerStart').val()
                        dateEnd = $('#datepickerEnd').val()
                    if(dateEnd < dateStart){
                        $('#datepickerStart').val('')
                        $('.messageAdd').text("Start event date is incorrect ")
                        $('.messageAdd').show()
                    }else{
                        $('.messageAdd').text('')
                        $('.messageAdd').hide()
                    }
                }
            });

            $('#datepickerEnd').datepicker({
                format: 'dd MM yyyy',
                autoclose: true,
                startDate: "dateToday"
            }).on('change', function(){
                var dateStart = $('#datepickerStart').val()
                var dateEnd = $('#datepickerEnd').val()
                if(dateStart > dateEnd){
                    $('#datepickerEnd').val('')
                    $('.messageAdd').text("End event date is incorrect ")
                    $('.messageAdd').show()
                }else{
                    $('.messageAdd').text('')
                    $('.messageAdd').hide()
                }
            });
        })

        $('#addNewDiscount').click(function () {
            int = int + 1
            $('.inputDiscount').append($('<input>', {
                type: 'number',
                class: "form-control mt-2 discount" + int,
                name: "discount" + int,
                maxlength: "2",
                required: true,
                oninput: "this.value=this.value.slice(0,this.maxLength)",
                placeholder: "Discount percent"
            }))
        })

        $('#removeNewDiscount').click(function () {
            console.log(int)
            $(".discount" + int).remove()
            int = int - 1
        })

        $('.delete').click(function () {
            $('#modalDelete').modal();
            $('.productDelete').text($(this).attr('data-name'));
            var idDelete = $(this).attr('data-id')
            console.log(idDelete)
            $('.deleteYes').attr('href', "/admin/sale/delete/" + idDelete)
        })

        $('.view').click(function () {
            var id = $(this).attr('data-id');
            $.ajax({
                    url: '/admin/sale/view/' + id,
                    type: 'get',
                }).done(function (data) {
                    $('#modalView').modal()
                    data[0].forEach(element => {
                        var dateStart = moment(element.start_event).format("DD MMMM YYYY")
                        var dateEnd = moment(element.end_event).format("DD MMMM YYYY")
                        $('#nameEvent').val(element.name_event)
                        $('#datepickerStartView').val(dateStart)
                        $('#datepickerEndView').val(dateEnd)
                        $('.statusEventView').val(element.status == 1 ? "True" : "False")
                    });
                    var id = 0
                    data[1].forEach(element => {
                        id = id + 1
                        $('#inputDiscount').append($('<input>', {
                            id: 'discount' + id,
                            type: 'text',
                            class: "form-control mt-2 discount",
                            name: "discount",
                            readOnly: true,
                            value: element.discount + " %",
                            placeholder: "Discount percent",
                            style: "background-color: white !important"
                        }))
                    })

                })
                .fail(function () {
                    $(".discount")
                });
        })

        $('#modalView').on('hidden.bs.modal', function (e) {
            $('input[name="discount"]').remove();
        })
    </script>
    @endsection