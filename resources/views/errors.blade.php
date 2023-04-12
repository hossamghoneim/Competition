@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li style="text-align: center;list-style: none;">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (Session::has('error'))
        <li class="alert alert-danger" role="alert" id="error" style="text-align: center; list-style: none;" >{{Session::get('error')}}</li>
        <?php Session::put('error', null); ?>
@endif

<script type="text/javascript">
    setTimeout(function() {
        $('#message').hide()
    }, 4000);
</script>

