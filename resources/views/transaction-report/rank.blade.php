<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Rank Report</title>
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
                                <h4 class="card-title">Rank Report</h4>
                                <p class="card-title-desc"></p>

                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns">
                                        <table id="transaction-reports" class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Top</th>
                                                <th>Distributor Name</th>
                                                <th>Total Sales</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ranks as $rank)
                                                <tr>
                                                    <th>{{ $loop->iteration }}</th>
                                                    <td>{{ $rank->name }}</td>
                                                    <td>{{ $rank->total_sales }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    {!! $ranks->links() !!}
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
