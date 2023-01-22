<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Invoices</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- App favicon -->

    <!-- Responsive Table css -->

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css"/>
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
                                <a href="{{ url()->previous() }}" class="btn btn-success">Back</a>
                                <h4 class="card-title">Invoice:{{ $order->invoice_number }}</h4>
                                <p class="card-title-desc"></p>

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="transaction-reports" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>SKU</th>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($order->orderItems as $item)
                                                <tr>
                                                    <th>{{ $item->product->sku }}</th>
                                                    <td>{{ $item->product->name }}</td>
                                                    <td>{{ $item->product->price }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->quantity*$item->product->price }}</td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
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

<script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>
