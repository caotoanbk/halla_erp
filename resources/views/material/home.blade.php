@extends('layouts.manage')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Quick overview</h1>
    </div>
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/supplier')}}">Total Suppliers</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Supplier::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/materialtype')}}">Total Materialtypes</a></div>
                  <div class="h3 mb-0 font-weight-bold text-gray-800">{{ count(\App\Materialtype::all()) }}</div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/material')}}">Total Materials</a></div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ count(\App\Material::all()) }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/area')}}">Total Areas</a></div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ count(\App\Area::all()) }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-3 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-sm font-weight-bold text-primary text-uppercase mb-1"><a href="{{url('crud/storage')}}">Total Storages</a></div>
                  <div class="row no-gutters align-items-center">
                    <div class="col-auto">
                      <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ count(\App\Storage::all()) }}</div>
                    </div>
                  </div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-archive fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>
@endsection