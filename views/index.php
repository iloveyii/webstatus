<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>Web Status</title>

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>


    <style>
        /*    --------------------------------------------------
	:: General
	-------------------------------------------------- */
        body {
            font-family: 'Open Sans', sans-serif;
            color: #353535;
        }

        .content h1 {
            text-align: center;
        }

        .content .content-footer p {
            color: #6d6d6d;
            font-size: 12px;
            text-align: center;
        }

        .content .content-footer p a {
            color: inherit;
            font-weight: bold;
        }

        /*	--------------------------------------------------
            :: Table Filter
            -------------------------------------------------- */
        .panel {
            border: 1px solid #ddd;
            background-color: #fcfcfc;
        }

        .panel .btn-group {
            margin: 15px 0 30px;
        }

        .panel .btn-group .btn {
            transition: background-color .3s ease;
        }

        .table-filter {
            background-color: #fff;
            border-bottom: 1px solid #eee;
        }

        .table-filter tbody tr:hover {
            cursor: pointer;
            background-color: #eee;
        }

        .table-filter tbody tr td {
            padding: 10px;
            vertical-align: middle;
            border-top-color: #eee;
        }

        .table-filter tbody tr.selected td {
            background-color: #eee;
        }

        .table-filter tr td:first-child {
            width: 38px;
        }

        .table-filter tr td:nth-child(2) {
            width: 35px;
        }

        .ckbox {
            position: relative;
        }

        .ckbox input[type="checkbox"] {
            opacity: 0;
        }

        .ckbox label {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .ckbox label:before {
            content: '';
            top: 1px;
            left: 0;
            width: 18px;
            height: 18px;
            display: block;
            position: absolute;
            border-radius: 2px;
            border: 1px solid #bbb;
            background-color: #fff;
        }

        .ckbox input[type="checkbox"]:checked + label:before {
            border-color: #2BBCDE;
            background-color: #2BBCDE;
        }

        .ckbox input[type="checkbox"]:checked + label:after {
            top: 3px;
            left: 3.5px;
            content: '\e013';
            color: #fff;
            font-size: 11px;
            font-family: 'Glyphicons Halflings';
            position: absolute;
        }

        .table-filter .star {
            color: #ccc;
            text-align: center;
            display: block;
        }

        .table-filter .star.star-checked {
            color: #F0AD4E;
        }

        .table-filter .star:hover {
            color: #ccc;
        }

        .table-filter .star.star-checked:hover {
            color: #F0AD4E;
        }

        .table-filter .media-photo {
            width: 35px;
        }

        .table-filter .media-body {
            display: block;
            /* Had to use this style to force the div to expand (wasn't necessary with my bootstrap version 3.3.6) */
        }

        .table-filter .media-meta {
            font-size: 11px;
            color: #999;
        }

        .table-filter .media .title {
            color: #2BBCDE;
            font-size: 14px;
            font-weight: bold;
            line-height: normal;
            margin: 0;
        }

        .table-filter .media .title span {
            font-size: .8em;
            margin-right: 20px;
        }

        .table-filter .media .title span.pagado {
            color: #5cb85c;
        }

        .table-filter .media .title span.pendiente {
            color: #f0ad4e;
        }

        .table-filter .media .title span.cancelado {
            color: #d9534f;
        }

        .table-filter .media .summary {
            font-size: 14px;
        }
        p {
            padding: 5px;
        }
    </style>
</head>

<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 style="padding: 10px;">Web Status</h5>
    <hr>
</div>

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">PHP Coding Test</h1>
</div>

<div class="container">
    <div class="row">

        <section class="content">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-success btn-filter" data-target="status200">Status
                                    200
                                </button>
                                <button type="button" class="btn btn-danger btn-filter" data-target="status500">Status
                                    500
                                </button>
                                <button type="button" class="btn btn-info btn-filter" data-target="all">All</button>
                            </div>
                        </div>
                        <div class="table-container">
                            <table class="table table-filter">
                                <tbody>
                                <?php foreach ($data as $url => $status): ?>

                                    <tr data-status="<?= $status == 1 ? 'status200' : 'status500' ?>">
                                        <td>
                                            <div class="ckbox">
                                                <input type="checkbox" id="checkbox<?=$id=rand(1, 100)?>">
                                                <label for="checkbox<?=$id?>"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:;" class="star">
                                                <i class="glyphicon glyphicon-star"></i>
                                            </a>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="<?= $status == 1 ? $url . '/dist/img/favicons/favicon.ico' : '/no.png' ?>"
                                                         class="media-photo">
                                                </a>
                                                <div class="media-body">
                                                    <span class="media-meta pull-right"><?= date('F d, Y') ?></span>
                                                    <h4 class="title">
                                                        <?= $url ?>
                                                        <span class="pull-right <?= $status == 1 ? 'pagado' : ' cancelado' ?> ">
                                                            <?= $status == 1 ? '(&#10004;)' : '(&#10007;)' ?>

                                                        </span>
                                                    </h4>
                                                    <p class="summary"><?= $status == 1 ? 'This site is accessible' : 'This site is down' ?></p>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-container">
                            <table>
                            <tr data-status="status200 status500 all">
                                <td><a class="btn btn-success" href="/">Refresh</a></td>
                                <td> <p>Your unique UUID is : <?=$uuid?></p></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="content-footer">
                    <p>
                        Page © - 2019 <br>
                        Powered By <a href="https://company.com" target="_blank">Company</a>
                    </p>
                </div>
            </div>
        </section>

    </div>
</div>

<!-- Placed at the end of the document so the pages load faster -->
<script>
    $(document).ready(function () {

        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
            return true;
        });

    });
</script>
</body>
</html>
