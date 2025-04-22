@extends('layouts.app')
@section('content')
<x-sidebar.sidebar/>
<div class="container-fluid">
<!-- Small boxes (Stat box) -->
<div class="row">
    <div class="col-lg-3 col-6 mb-4">
    <!-- small box -->
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>150</h3>
                <p>Dashboard</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('inventory.dashboard') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>
                <p>Product</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>44</h3>
                <p>Account Management</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Supplies</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>65</h3>
                <p>Organization & Label</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>65</h3>
                <p>Settings</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6 mb-4">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>65</h3>
                <p>Log out</p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
</div>
<!-- Main row -->
<div class="row">

</div>
@endsection