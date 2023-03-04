@extends('MasterAdmin.app')

@section('content')
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="col-md">
                <div class="row justify-content-center pb-2 pt-4">
                    <div class="col-md-8 text-left">
                        <h4 class="text-dark">Edit Event Sale</h4>
                    </div>

                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="alert alert-warning alert-dismissible fade show messageEdit" style="display: none">
                    </div>
                    <div class="card card-info card-outline">
                        <div class="card-body p-10">
                            <form role="form" action="{{ url('/admin/sale/saveEvent') }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group" style="display: none">
                                    <input type="text" class="form-control" name="idEvent" value="{{ $idevent }}"
                                        required readonly>
                                </div>
                                <div class="form-group" style="display: none">
                                    <input type="text" class="form-control" name="createAt"
                                        value="{{ $discountDate[0]->create_at }}" required readonly>
                                </div>
                                <div class="form-group">
                                    <label for="nameEvent">Name Event</label>
                                    <input type="text" class="form-control" name="nameEvent" value="{{ $name_event }}"
                                        required>
                                </div>
                                <div class="row">
                                    <div class="col form-group">
                                        <label for="startEvent">Start Event</label>
                                        <input type="text" class="form-control" id="datepickerStart" name="dateStart"
                                            value="{{ $start_event }}" style="background-color: white !important;"
                                            required>
                                    </div>
                                    <div class="col form-group">
                                        <label for="endEvent">End Event</label>
                                        <input type="text" class="form-control" id="datepickerEnd" name="dateEnd"
                                            value="{{ $end_event }}" style="background-color: white !important;"
                                            required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="statusEvent" class="mb-0">Status Ready</label>
                                    <p style="font-size: 13px; color: #a7a7a7; margin-bottom: 10px !important">Status
                                        for event to ready</p>
                                    <select class="form-control statusEvent" id="statusEvent" name="statusEvent"
                                        required>
                                        <option value="1"
                                            {{ $status == 1 ? "selected" : "" }}>
                                            True</option>
                                        <option value="0"
                                            {{ $status == 0 ? "selected" : "" }}>
                                            False</option>
                                    </select>
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-sm-3 text-center">
                                        <label for="discount" class="col-form-label">Discount</label>
                                        <hr class="my-0 mx-2">
                                        <div class="text-center">
                                            <div class="col mt-2">
                                                <button type="button" class="btn btn-primary addNewDiscount"
                                                    value="{{ count($discount) }}">
                                                    <i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 rowDiscount">
                                        @foreach($discount as $key => $items)
                                            <div class="row inputDiscount{{ $key+1 }}">
                                                <div class="col-11">
                                                    <input type="number" maxlength="2" class="form-control mb-2"
                                                        name="discount{{ $key }}" value="{{ $items->discount }}"
                                                        required oninput="this.value=this.value.slice(0,this.maxLength)"
                                                        placeholder="Discount percent">
                                                </div>
                                                <div class="col-1">
                                                    <button type="button"
                                                        class="btn btn-danger removeNewDiscount{{ $key+1 }}"
                                                        id="{{ $key+1 }}" onclick="DeleteRow({{ $key+1 }})">
                                                        <i class="fa fa-minus" aria-hidden="true"
                                                            style="color: white"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                @if($haveItem)
                                    <div class="mx-5">
                                        <div class="loader" id="loader" style="display: none"></div>
                                        <button type="submit" id="submit" class="btn btn-info btn-block">Save</button>
                                        <div id="messageStatus" class="text-center messageStatus">
                                            <p class="mb-0">Can't to be save, some event have already in status
                                                <i>Ready</i>
                                            </p>
                                        </div>
                                    </div>
                                @else
                                    <div class="mx-5">
                                        <div class="loader" id="loader" style="display: none"></div>
                                        <button type="button" class="btn btn-info btn-block editDialog"
                                            data-target="#modelEdit">Save</button>
                                        <div id="messageStatus" class="text-center messageStatus">
                                            <p class="mb-0">Can't to be save, some event have already in status
                                                <i>Ready</i>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="modelEdit">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Event Sale</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="text-center">Are you sure, will edit the event ?</p>
                                                    <p class="text-center" style="font-size: 20px">
                                                        <b class="productDelete"></b>
                                                    </p>
                                                    <p class="text-center mb-0" style="color: #a7a7a7; font-size: 14px">
                                                        <i>Edit event can be to
                                                            remove product have same event</i></p>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col">
                                                            <button type="submit" id="submit"
                                                                class="btn btn-danger btn-block deleteYes">Yes</button>
                                                        </div>
                                                        <div class="col">
                                                            <button class="btn btn-secondary btn-block"
                                                                data-dismiss="modal" aria-label="Close">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            </form>
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
        $(document).ready(function () {
            $('#datepickerStart').datepicker({
                format: 'dd MM yyyy',
                autoclose: true,
                startDate: "dateToday",
            }).on('change', function () {
                $('.messageEdit').text("")
                $('.messageEdit').hide()
                if ($('#datepickerEnd').val() != '') {
                    var dateStart = $('#datepickerStart').val()
                    dateEnd = $('#datepickerEnd').val()
                    if (dateEnd < dateStart) {
                        $('#datepickerStart').val('')
                        $('.messageEdit').text("Start event date is incorrect ")
                        $('.messageEdit').show()
                    } else {
                        $('.messageEdit').text('')
                        $('.messageEdit').hide()
                    }
                }
            });

            $('#datepickerEnd').datepicker({
                format: 'dd MM yyyy',
                autoclose: true,
                startDate: "dateToday"
            }).on('change', function () {
                var dateStart = $('#datepickerStart').val()
                dateEnd = $('#datepickerEnd').val()
                if (dateStart > dateEnd) {
                    console.log("sempak")
                    $('#datepickerEnd').val('')
                    $('.messageEdit').text("End event date is incorrect ")
                    $('.messageEdit').show()
                } else {
                    console.log("coks")
                    $('.messageEdit').text('')
                    $('.messageEdit').hide()
                }
            });
        })

        $('.editDialog').click(function () {
            $('#modelEdit').modal();
            console.log("sempak");
        })

        $('.addNewDiscount').click(function () {
            console.log("sempak")
            var value = parseInt($('.addNewDiscount').val());
            var nextValue = value + 1;
            var elemtent = $("<div class=\"row inputDiscount" + nextValue +
                "\"><div class=\"col-11\"><input type=\"number\" name=\"discount" + nextValue +
                "\" maxlength=\"2\" class=\"form-control mb-2\" required oninput=\"this.value=this.value.slice(0,this.maxLength)\" placeholder=\"Discount percent\"></div><div class=\"col-1\"><button type=\"button\" class=\"btn btn-danger removeNewDiscount" +
                nextValue + "\" id=\"" + nextValue + "\" onclick=\"DeleteRow(" + nextValue +
                ")\"><i class=\"fa fa-minus\" aria-hidden=\"true\" style=\"color: white\"></i></button></div></div>"
            );

            $('.rowDiscount').append(elemtent)
            $('.addNewDiscount').val(value + 1)
        })

        function DeleteRow(value) {
            if (value != 1) {
                $(".inputDiscount" + value).remove()
            }
        }

        var valueStatus = $('.statusEvent').val()
        $('.statusEvent').click(function () {
            var status = $('.statusEvent').val()
            dateStart = $('#datepickerStart').val()
            dateEnd = $('#datepickerEnd').val()
            dateNow = moment(new Date()).format('DD MMMM YYYY');

            if (status == 1) {
                if (dateNow >= dateStart && dateNow <= dateEnd) {
                    $('.messageEdit').text("")
                    $('.messageEdit').hide()
                } else {
                    $('.messageEdit').text("Status can't true because, date now not same for date start")
                    $('.messageEdit').show()
                    $('.statusEvent').val(valueStatus)
                }
            } else {
                $('.messageEdit').text("")
                $('.messageEdit').hide()
            }
        })
    </script>
    @endsection