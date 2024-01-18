@extends('firebase.app')
<title>Mail - SponsorQu</title>

@section('content')
<div class="container">
    <div class="row">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?php
        $i=1;
        ?>
        
        @foreach ($filteredMails as $key => $item)
        <div class="card p-3" >
            <a href="{{ url('viewmail/'.$item['id']) }}">
            {{ $item['subject'] }}
            </a>
        </div>
        @endforeach
    </div>
    <div class="col-md-1"></div>
    </div>
</div>

@endsection
