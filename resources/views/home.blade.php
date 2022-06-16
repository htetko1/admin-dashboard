@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <i class="fa fa-home"></i>
                    {{ __('You are logged in!') }}
                    <button class="btn btn-primary test">Test</button>
                </div>
                <br>
                {{ date('d - m - y | h : i : a') }}
                <br>
                <br>
                <br>
                <br>
                <div class="col-6">
                    <button class="btn btn-success text-alert">Test Alert</button>
                    <button class="btn btn-outline-success text-toast colored-toast swal2-icon-success">Test Toast</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Button trigger modal -->
{{--<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">--}}
{{--    Launch static backdrop modal--}}
{{--</button>--}}

{{--<!-- Modal -->--}}
{{--@include('user-profile.update-info')--}}
@endsection
@section('foot')
    <script>
        $('.test').click(function (){
            alert("home");
        })

        $(".text-alert").click(function (){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: '<a href="">Why do I have this issue?</a>'
            })
        });

        $(".text-toast").click(function(){
            const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-right',
                iconColor: 'white',
                customClass: {
                    popup: 'colored-toast'
                },
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen:(toast)=> {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
                Toast.fire({
                icon: 'success',
                title: 'Success'
            })
        });
    </script>

@endsection
