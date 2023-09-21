@extends('admin.admin_dashboard')
@section('admin')
{{-- <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@php

$test = array();
$count = 0;
$res = $results->toArray();

$labels = array_column($res, 'type_name');
$values = array_column($res, 'total_budget_request');

@endphp

<div class="page-content">

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
      <div>
        <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
      </div>
      <div class="d-flex align-items-center flex-wrap text-nowrap">
        <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
          <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
          <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
        </div>
        <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="printer"></i>
          Print
        </button>
        <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
          <i class="btn-icon-prepend" data-feather="download-cloud"></i>
          Download Report
        </button>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">APPROVED BUDGETS</h6>
            </div>
            <p class="text-muted">TOTAL APPROVED BUDGET</p>
            {{-- <div id="monthlySalesChart"></div> --}}
            {{-- <div id="chartContainer" style="height: 370px; width: 100%;"></div> --}}
            <div>
              <canvas id="myChart"></canvas>
            </div>
            

          </div> 
        </div>
      </div>
   
    </div> <!-- row -->

        </div>

          <script>
            const ctx = document.getElementById('myChart');
          
            new Chart(ctx, {
              type: 'bar',
              data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                  label: 'Total Budget Request',
                  data: <?php echo json_encode($values); ?>,
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
          </script>
          
          
@endsection