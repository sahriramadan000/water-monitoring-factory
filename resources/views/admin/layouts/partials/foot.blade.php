{{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script> --}}
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/socket.io.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-confirm@3.3.4/js/jquery-confirm.min.js"></script>
@stack('js-src')

<script>
    let socket = window.socketio;
    socket = io('http://localhost:2222', {transports: ["websocket"]});

    function restarGateway() {
        $.confirm({
            icon: 'bx bx-sync',
            title: 'Restart Gateway',
            theme: 'supervan',
            content: 'Are you sure?',
            autoClose: 'cancel|8000',
            buttons: {
                yes: {
                    text: 'yes',
                    action: function () {
                        $.ajax({
                            type: 'POST',
                            url: 'http://localhost:2222/restart-gateway',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            data: {
                                "_token": "{{ csrf_token() }}",
                                data: 'restart'
                            },
                            success: function (data) {
                            },
                            error: function (data) {
                            }
                        });
                    }
                },
                cancel: function () {

                }
            }
        });
    }
</script>
@stack('js')
