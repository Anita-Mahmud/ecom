@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <span class="breadcrumb-item active">Dashboard</span>
      </nav>
     <h1> Please Verify Your Email</h1>
      <div class="sl-pagebody">
       <form action="{{route('verification.send')}}" method="POST">
      @csrf
     <button type="Submit"> Resend Mail
     </button>
     </form>
    </div><!-- sl-pagebody -->
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->
@endsection




