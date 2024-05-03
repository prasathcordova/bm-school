<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Token</h2>
        <ol class="breadcrumb">
            <li>
                <a href="index.html">Employee Sale</a>
            </li>

            <li class="active">
                <strong>Token</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">

            <a href="invoice_print.html" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print Token </a>
        </div>
    </div>
</div>
<!--<div class="row">-->
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>From:</h5>
                        <address>
                            <strong>New Indian Model School, Dubai.</strong><br>
                            5th St-United Arab Emirates<br>
                            <abbr title="Phone">P:</abbr> (971)4 282-4313
                        </address>
                    </div>

                    <div class="col-sm-6 text-right">
                        <h4>Token No.</h4>
                        <h4 class="text-navy">PCK-000567F7-00</h4>
                        <span>To:</span>
                        <address>
                            <strong>Mohammed Aslam Khan</strong><br>
                            Principal<br>
                            Nims, dubai<br>
                            <abbr title="Phone">P:</abbr> (971)4 282-4313
                        </address>
                        <p>
                            <span><strong>Invoice Date:</strong> March 18, 2018</span><br />
                            <span><strong>Due Date:</strong> March 24, 2018</span>
                        </p>
                    </div>
                </div>

                <div class="table-responsive m-t">
                    <table class="table invoice-table">
                        <thead>
                            <tr>
                                <th>Item List</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th><?php echo TAXNAME ?></th>
                                <th>Total Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div><strong>Physics Text</strong></div>
                                    <small>Modern physics is the post-Newtonian conception of physics.</small>
                                </td>
                                <td>1</td>
                                <td>Dhs 26.00</td>
                                <td>Dhs 5.98</td>
                                <td>Dhs 31,98</td>
                            </tr>
                            <tr>
                                <td>
                                    <div><strong>Chemistry Text</strong></div>
                                    <small>Chemistry is the scientific discipline involved with compounds composed of atoms.
                                    </small>
                                </td>
                                <td>2</td>
                                <td>Dhs 80.00</td>
                                <td>Dhs 36.80</td>
                                <td>Dhs 196.80</td>
                            </tr>
                            <tr>
                                <td>
                                    <div><strong>Pen</strong></div>
                                    <small>A ballpoint pen, also known as a biro, or ball pen, is a pen that dispenses ink over a metal ball at its point, i.e. over a "ball point".</small>
                                </td>
                                <td>3</td>
                                <td> Dhs 42.00</td>
                                <td>Dhs 19.20</td>
                                <td>Dhs 10.20</td>
                            </tr>

                        </tbody>
                    </table>
                </div><!-- /table-responsive -->

                <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>Dhs 1026.00</td>
                        </tr>
                        <tr>
                            <td><strong><?php echo TAXNAME ?> :</strong></td>
                            <td>Dhs 235.98</td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td>Dhs 1261.98</td>
                        </tr>
                    </tbody>
                </table>
                <div class="text-right">
                    <button class="btn btn-primary"><i class="fa fa-money"></i> Make A Payment</button>
                </div>

                <div class="well m-t"><strong>Comments:</strong>
                    Goods once sold will not be taken back or exchange.If any damage found the customer has to notice at the time of purchase.
                </div>
            </div>
        </div>
    </div>
</div>