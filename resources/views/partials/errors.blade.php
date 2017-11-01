{{-- By using withErrors function in web.php file, Laravel automatically gives us $errors variable --}}
@if(count($errors->all()))
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger">
        <ul>
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
@endif
