@extends('layout.AdminLayout')
@section('content')
    {{--todo breadcumb--}}
    <x-breadcumb.base-breadcumb :routeName="$routeName"></x-breadcumb.base-breadcumb>
    <section class="section">
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-success d-none" id="success"></div>
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-left justify-content-between">
                            <h5 class="card-title">Brands</h5>
                            <button  data-bs-toggle="modal" data-bs-target="#addBrand" class="btn btn-secondary h-25 mt-2">
                                <i class="bi bi-plus-circle"></i>
                                <span>Add</span>
                            </button>
                        </div>

                        <!-- Table with stripped rows -->
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">brandName</th>
                                <th scope="col">brandStatus</th>
                                <th scope="col">categoryAction</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brands as $key => $brand)
                                <tr>
                                    <th scope="row">{{$key + 1}}</th>
                                    <td>{{$brand['brandName']}}</td>
                                    <td>{{$brand['brandStatus']}}</td>
                                    <td>
                                        <button
                                            value="{{$brand['brandId']}}"
                                            updateCategory class="btn btn-primary btn-sm edit">
                                            Edit
                                        </button>
                                        <button
                                            value="{{$brand['brandId']}}"
                                            class="btn btn-danger btn-sm delete">
                                            Delete
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with stripped rows -->

                    </div>
                </div>

            </div>
        </div>
        @include('components.modal.BrandModal')
    </section>
@endsection
@section('scripts')
    <script>

        $(document).ready(function () {

            const addBrandForm = $('#addBrandForm')
            const updateBrandForm = $('#updateBrandForm')
            //todo add submit
            addBrandForm.on('submit', function (e) {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                $.ajax({
                    type: addBrandForm.attr('method'),
                    url: addBrandForm.attr('action'),
                    data: addBrandForm.serialize(),
                    success: (response) => {
                        $('#error').addClass('d-none')
                        if (response.responseCode === "200") {

                            $('#success').removeClass('d-none').text(response.responseMessage)
                            $('#addBrand').modal('hide')
                            addBrandForm.trigger('reset')
                            setTimeout(() => {
                                $('#success').addClass('d-none').text("")
                                location.reload()
                            }, 3000)
                        }

                    },
                    error: (error) => {
                        $('#success').addClass('d-block')
                        $('#error').removeClass('d-none').text(error.responseJSON.message)
                    }

                })
            })

            //todo fetch category by id
            $('.edit').on('click', function (e) {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                const data ={
                    brandId: $(this).val()
                }
                $('#updateBrand').modal('show')
                $.ajax({
                    type:'POST',
                    url:'{{route('readByIdBrand')}}',
                    data:data,
                    success:(response)=>{
                        if (response.responseCode === 200){
                            console.log(response.data)
                            $('#brandName').val(response.data.brandName)
                            $('#brandId').val(response.data.brandId)
                        }else {
                            $('#error').val(response.responseMessage)
                        }
                    },
                    error:(error)=>{
                        alert(error.response)
                    }
                })

                console.log(data)
            })

            //todo edit submit
            updateBrandForm.on('submit', function (e) {
                e.preventDefault()
                console.log(updateBrandForm.serialize())
                $.ajax({
                    type:updateBrandForm.attr('method'),
                    url:updateBrandForm.attr('action'),
                    data:updateBrandForm.serialize(),
                    success:(response)=>{
                        $('#error').addClass('d-none')
                        if (response.responseCode === "200") {
                            $('#success').removeClass('d-none').text(response.responseMessage)
                            $('#updateBrand').modal('hide')
                            updateBrandForm.trigger('reset')
                            setTimeout(() => {
                                $('#success').addClass('d-none').text("")
                                location.reload()
                            }, 3000)
                        }

                    },
                    error:(error)=>{
                        $('#success').addClass('d-block')
                        $('#error').removeClass('d-none').text(error.responseJSON.message)
                    }
                })
            })

            //todo delete category by id
            $('.delete').on('click', function (e) {
                e.preventDefault()
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                })
                const data ={
                    brandId: $(this).val()
                }

                $.ajax({
                    type:'POST',
                    url:'{{route('deleteBrand')}}',
                    data:data,
                    success:(response)=>{
                        $('#error').addClass('d-none')
                        if (response.responseCode === "200"){
                            console.log(response.data)
                            $('#success').removeClass('d-none').text(response.responseMessage)
                            setTimeout(() => {
                                $('#success').addClass('d-none').text("")
                                location.reload()
                            }, 3000)
                        }else {
                            $('#error').val(response.responseMessage)
                        }
                    }
                })

                console.log(data)
            })
        })
    </script>
@endsection

