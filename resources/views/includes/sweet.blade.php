<script defer>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-' + '{{App::getLocale() == "ar" ? 'left' : 'end'}}',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });
    const swal = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ml-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    });

    @if($errors->any())
        @foreach($errors->all() as $err)
            Toast.fire({
                icon: 'error',
                title: '{{$err}}'
            });
        @endforeach
    @endif
    @if(session('error'))
        @foreach(session('error') as $err)
            Toast.fire({
                icon: 'error',
                title: '{{$err}}'
            });
        @endforeach
    @endif
    @if(session('success'))
        @foreach(session('success') as $suc)
            Toast.fire({
                icon: 'success',
                title: '{{$suc}}'
            });
        @endforeach
    @endif
    @if(session('warning'))
        @foreach(session('warning') as $war)
            Toast.fire({
                icon: 'warning',
                title: '{{$war}}'
            });
        @endforeach
    @endif
    @if(session('info'))
        @foreach(session('info') as $inf)
            Toast.fire({
                icon: 'info',
                title: '{{$inf}}'
            });
        @endforeach
    @endif
    @if(session('confirm'))
        @php
            $ask = session('confirm');
        @endphp
        swal.fire({
            title: '{{$ask['title']}}',
            text: '{{isset($ask['text']) ? $ask['text'] : ''}}',
            icon: '{{isset($ask['icon']) ? $ask['icon'] : 'info'}}',
            showCancelButton: true,
            confirmButtonText: '{{isset($ask['yesbtn']) ? $ask['yesbtn'] : 'Yes'}}',
            cancelButtonText: '{{isset($ask['nobtn']) ? $ask['nobtn'] : 'No'}}',
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                location.assign('{{route($ask['route'])}}');
            }/*  else if (
                /* Read more about handling dismissals below 
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                'Cancelled',
                'Your imaginary file is safe :)',
                'error'
                )
            } */
        });
    @endif
    function sconfirm(title, {icon, yesbtn, nobtn}, yescallback, nocallback){
        swal.fire({
            title: title,
            text: '',
            icon: icon,
            showCancelButton: true,
            confirmButtonText: yesbtn,
            cancelButtonText: nobtn,
            reverseButtons: true
        }).then((result) => {
            if (result.value) {
                yescallback();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                nocallback();
            }
        });
    }
</script>