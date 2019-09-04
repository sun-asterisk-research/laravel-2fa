<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="verify_code" class="col-md-4 control-label">Verify Code</label>

    <div class="col-md-6">
        <input id="verify_code" type="text" class="form-control" name="verify_code" required autofocus>
    </div>

    <div class="col-md-6 col-md-offset-4">
        <button type="submit" class="btn btn-primary">
            Login
        </button>
    </div>
</form>
