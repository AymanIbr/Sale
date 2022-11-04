@if (Session::has('error'))
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    {{ Session::get('error')}}
  </div>
@endif

