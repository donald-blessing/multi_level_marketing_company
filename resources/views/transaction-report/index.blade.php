<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Orders</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->

    <!-- Responsive Table css -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
    <link href="{{ asset("assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css") }}" rel="stylesheet">
    <!-- Icons Css -->
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- Begin page -->
<div id="layout-wrapper">

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <a href="{{ route('view-ranks') }}" class="btn btn-success">View Rankings</a>
                                <h4 class="card-title">Transaction Report</h4>
                                <p class="card-title-desc"></p>
                                <div class="row">
                                    <div class="col-md-10">

                                        <form action="{{ route('index') }}" method="get">
                                            @csrf
                                            <div class="form-group">
                                                <label for="distributor">Distributor</label>
                                                <input autocomplete type="text" name="distributor" class="form-control"
                                                       id="distributor">
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Date from:</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                                               name="date_from" id="datepicker">
                                                        <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                                <label class="col-sm-2 col-form-label">to</label>
                                                <div class="col-sm-3">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" placeholder="mm/dd/yyyy"
                                                               name="date_to" id="datepicker">
                                                        <div class="input-group-append">
                                                    <span class="input-group-text"><i
                                                            class="mdi mdi-calendar"></i></span>
                                                        </div>
                                                    </div><!-- input-group -->
                                                </div>
                                                <button type="submit" class="col-sm-2 btn btn-primary">Filter</button>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="col-md-2">
                                        <h4 class="card-title">
                                            TOTAL COMMISSION:<br/>
                                            {{ $totalCommission }}
                                        </h4>
                                    </div>

                                </div>

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="transaction-reports" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Imvoice</th>
                                                <th>Purchaser</th>
                                                <th>Distributor</th>
                                                <th>Referred Distributors</th>
                                                <th>Order Date</th>
                                                <th>Order Total</th>
                                                <th>Percentage</th>
                                                <th>Commission</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($orders as $order)
                                                <tr>
                                                    <th>{{ $order->invoice_number }}</th>
                                                    <td>{{ $order->purchaser->first_name }} {{ $order->purchaser->last_name }}</td>
                                                    <td>{{ $order->getDistributor()?->first_name }} {{ $order->getDistributor()?->last_name }}</td>
                                                    <td>{{ $order->getNumberOfReferredDistributors() }}</td>
                                                    <td>{{ $order->order_date->format('m-d-Y') }}</td>
                                                    <td>{{ $order->getTotal() }}</td>
                                                    <td>{{ $order->getPercentage()*100 }}%</td>
                                                    <td>{{ $order->getCommission() }}</td>
                                                    <td><a href="{{ route('view-items',$order->id) }}"
                                                           class="btn btn-primary">View Items</a></td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! $orders->links() !!}
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->


            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->


<!-- JAVASCRIPT -->
<script src="{{ asset('assets/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>
