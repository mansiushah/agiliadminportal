@if ($message = Session::get('success'))
<div class="card-alert card green">
    <div class="card-content white-text">
         <p>{{ $message }}</p>
    </div>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="card-alert card red">
<div class="card-content white-text">
    <p>{{ $message }}</p>
</div>
</div>
@endif
   
@if ($message = Session::get('warning'))

 <div class="card-alert card orange">
    <div class="card-content white-text">
        <p>{{ $message }}</p>
    </div>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="card-alert card gradient-45deg-light-blue-cyan">
<div class="card-content white-text">
    <p>
        <i class="material-icons">info_outline</i>{{ $message }}</p>
</div>
</div>
@endif

