<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    {{-- logo --}}
    <link rel="shortcut icon" href="{{asset('images/s.png')}}">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    {{-- font awesome --}}
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.1/css/all.css"
    integrity="sha384-xxzQGERXS00kBmZW/6qxqJPyxW3UR0BPsL4c8ILaIWXva5kFi7TxkIIaMiKtqV1Q" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
    {{-- owl carousel --}}
    <link rel="stylesheet" href="{{asset('owlcarousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('owlcarousel/css/owl.theme.default.min.css')}}">
    {{-- css --}}
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto+Condensed">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{ asset('css/app.scss') }}">
    @yield('css')
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
</head>
<body>

    @include('frontend.layouts.header')


    @yield('main')


    @include('frontend.layouts.footer')



    {{-- Jquery --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    {{-- Bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    {{-- js --}}
    <script src="{{asset('owlcarousel/js/owl.carousel.min.js')}}"></script>
    {{-- <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/moment.min.js') }}"></script> --}}
    <script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{asset('js/script.js')}}"></script>
    @yield('js')
    <script>
        $(document).ready(function(){
            var _token = $('input[name="_token"]').val();

            $('#btnAll').click(function(){
                $.ajax({
                    url:"{{ url('users/notifications') }}",
                    method:"POST",
                    data:{_token:_token},
                    success:function(data){
                        $('.notiTime').css('color','black');
                    }
                });
            })


        });


    </script>
    @isset($notifications)
    <script>
        $(document).ready(function(){
        <?php $maxN = count($notifications);
        for($i = 0; $i<$maxN ; $i++){ ?>
            $('#notiValue{{ $i }}').click(function(){
            var url = $('#notiValue{{ $i }}').data('value');
            var valueNoti = $('#notiValue{{ $i }}').data('noti');

            $.ajax({
                url:"{{ url('users/notification') }}",
                method:"POST",
                data:{noti_id:valueNoti , _token:_token},
                success:function(data){
                    window.open(url,'_blank');
                    $('#notiTime{{ $i }}').css('color','black');
                }
            });
        });
    <?php } ?>
    });
    </script>
    @endisset
</body>
</html>
