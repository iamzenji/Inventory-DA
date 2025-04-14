@extends('layouts.app')
@section('content')
<x-header.header/>
<div class="container">
    
    <div class="row">
            <x-input
                label="First Name"
                placeholder="Pls input first Name"
                col="col-sm-12"
            />
            <x-input
            label="Middle Name"
            placeholder="Pls input Middle Name"
            col="col-sm-12"
            />
            <x-input
                label="Last Name"
                placeholder="Pls input Last Name"
                col="col-sm-12"
            />
            <x-input
                label="Number"
                placeholder="Pls input Number"
                col="col-sm-6"
            />
            <x-input
                label="Address"
                placeholder="Pls input Address "
                col="col-sm-6"
            />
    </div>
</div>
@endsection