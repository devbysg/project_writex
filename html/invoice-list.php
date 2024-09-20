<?php
include('layout/header.php');
?>
                <!-- main header @e -->
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="container-fluid">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                            <div class="nk-block-head nk-block-head-sm">
                                    <div class="nk-block-between">
                                        <div class="nk-block-head-content">
                                            <h3 class="nk-block-title page-title">Invoices</h3>
                                        </div><!-- .nk-block-head-content -->
                                        <div class="nk-block-head-content">
                                            <div class="toggle-wrap nk-block-tools-toggle">
                                                <a href="#" class="btn btn-icon btn-trigger toggle-expand me-n1" data-target="pageMenu"><em class="icon ni ni-more-v"></em></a>
                                                <div class="toggle-expand-content" data-content="pageMenu">
                                                    <ul class="nk-block-tools g-3">
                                                        <li>
                                                            <div class="form-control-wrap">
                                                                <div class="form-icon form-icon-right">
                                                                    <em class="icon ni ni-search"></em>
                                                                </div>
                                                                <input type="text" class="form-control" id="default-04" placeholder="Quick search by id">
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="drodown">
                                                                <a href="#" class="dropdown-toggle dropdown-indicator btn btn-outline-light btn-white" data-bs-toggle="dropdown">Status</a>
                                                                <div class="dropdown-menu dropdown-menu-end">
                                                                    <ul class="link-list-opt no-bdr">
                                                                        <li><a href="#"><span>New Items</span></a></li>
                                                                        <li><a href="#"><span>Featured</span></a></li>
                                                                        <li><a href="#"><span>Out of Stock</span></a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li class="nk-block-tools-opt">
                                                            <a href="#" class="toggle btn btn-icon btn-primary d-md-none"><i class="icon ni ni-share" style="color:white"></i></a>
                                                            <a href="#" class="toggle btn btn-primary d-none d-md-inline-flex"><i class="icon ni ni-share" style="color:white"></i></em></a>
                                                        </li>
                                                        <li class="nk-block-tools-opt">
                                                            <a href="#" data-target="addProduct" class="toggle btn btn-icon btn-primary d-md-none"><em class="icon ni ni-plus"></em></a>
                                                            <a href="#" data-target="addProduct" class="toggle btn btn-primary d-none d-md-inline-flex"><em class="icon ni ni-plus"></em><span>Add Invoice</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div><!-- .nk-block-head-content -->
                                    </div><!-- .nk-block-between -->
                                </div><!-- .nk-block-head -->
                                <div class="nk-block">
                                    <div class="card card-stretch">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="card-title-group">
                                                    <div class="card-title">
                                                        <h5 class="title">All Invoice</h5>
                                                    </div>
                                                    <div class="card-tools me-n1">
                                                        <ul class="btn-toolbar">
                                                            <li>
                                                                <a href="#" class="btn btn-icon search-toggle toggle-search" data-target="search"><em class="icon ni ni-search"></em></a>
                                                            </li><!-- li -->
                                                            <li class="btn-toolbar-sep"></li><!-- li -->
                                                            <li>
                                                                <div class="dropdown">
                                                                    <a href="#" class="btn btn-trigger btn-icon dropdown-toggle" data-bs-toggle="dropdown">
                                                                        <em class="icon ni ni-setting"></em>
                                                                    </a>
                                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-xs">
                                                                        <ul class="link-check">
                                                                            <li><span>Show</span></li>
                                                                            <li class="active"><a href="#">10</a></li>
                                                                            <li><a href="#">20</a></li>
                                                                            <li><a href="#">50</a></li>
                                                                        </ul>
                                                                        <ul class="link-check">
                                                                            <li><span>Order</span></li>
                                                                            <li class="active"><a href="#">DESC</a></li>
                                                                            <li><a href="#">ASC</a></li>
                                                                        </ul>
                                                                        <ul class="link-check">
                                                                            <li><span>Density</span></li>
                                                                            <li class="active"><a href="#">Regular</a></li>
                                                                            <li><a href="#">Compact</a></li>
                                                                        </ul>
                                                                    </div>
                                                                </div><!-- .dropdown -->
                                                            </li><!-- li -->
                                                        </ul><!-- .btn-toolbar -->
                                                    </div><!-- card-tools -->
                                                    <div class="card-search search-wrap" data-search="search">
                                                        <div class="search-content">
                                                            <a href="#" class="search-back btn btn-icon toggle-search" data-target="search"><em class="icon ni ni-arrow-left"></em></a>
                                                            <input type="text" class="form-control form-control-sm border-transparent form-focus-none" placeholder="Quick search by order id">
                                                            <button class="search-submit btn btn-icon"><em class="icon ni ni-search"></em></button>
                                                        </div>
                                                    </div><!-- card-search -->
                                                </div><!-- .card-title-group -->
                                            </div><!-- .card-inner -->
                                            <div class="card-inner p-0">
                                                <table class="table table-orders">
                                                    <thead class="tb-odr-head">
                                                        <tr class="tb-odr-item">
                                                            <th class="tb-odr-info">
                                                                <span class="tb-odr-id">Order ID</span>
                                                                <span class="tb-odr-date d-none d-md-inline-block">Date</span>
                                                            </th>
                                                            <th class="tb-odr-amount">
                                                                <span class="tb-odr-total">Amount</span>
                                                                <span class="tb-odr-status d-none d-md-inline-block">Status</span>
                                                            </th>
                                                            <th class="tb-odr-action">&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="tb-odr-body">
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#746F5K2</a></span>
                                                                <span class="tb-odr-date">23 Jan 2019, 10:45pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$2300.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-success">Complete</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#546H74W</a></span>
                                                                <span class="tb-odr-date">12 Jan 2020, 10:45pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$120.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-warning">Pending</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#87X6A44</a></span>
                                                                <span class="tb-odr-date">26 Dec 2019, 12:15 pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$560.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-success">Complete</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#986G531</a></span>
                                                                <span class="tb-odr-date">21 Jan 2019, 6 :12 am</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$3654.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-danger">Cancelled</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#326T4M9</a></span>
                                                                <span class="tb-odr-date">21 Jan 2019, 6 :12 am</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$200.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-success">Complete</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#746F5K2</a></span>
                                                                <span class="tb-odr-date">23 Jan 2019, 10:45pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$2300.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-success">Complete</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#546H74W</a></span>
                                                                <span class="tb-odr-date">12 Jan 2020, 10:45pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$120.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-warning">Pending</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                        <tr class="tb-odr-item">
                                                            <td class="tb-odr-info">
                                                                <span class="tb-odr-id"><a href="html/invoice-details.php">#87X6A44</a></span>
                                                                <span class="tb-odr-date">26 Dec 2019, 12:15 pm</span>
                                                            </td>
                                                            <td class="tb-odr-amount">
                                                                <span class="tb-odr-total">
                                                                    <span class="amount">$560.00</span>
                                                                </span>
                                                                <span class="tb-odr-status">
                                                                    <span class="badge badge-dot bg-success">Complete</span>
                                                                </span>
                                                            </td>
                                                            <td class="tb-odr-action">
                                                                <div class="tb-odr-btns d-none d-sm-inline">
                                                                    <a href="html/invoice-print.php" target="_blank" class="btn btn-icon btn-white btn-dim btn-sm btn-primary"><em class="icon ni ni-printer-fill"></em></a>
                                                                    <a href="html/invoice-details.php" class="btn btn-dim btn-sm btn-primary">View</a>
                                                                </div>
                                                                <a href="html/invoice-details.php" class="btn btn-pd-auto d-sm-none"><em class="icon ni ni-chevron-right"></em></a>
                                                            </td>
                                                        </tr><!-- .tb-odr-item -->
                                                    </tbody>
                                                </table>
                                            </div><!-- .card-inner -->
                                            <div class="card-inner">
                                                <ul class="pagination justify-content-center justify-content-md-start">
                                                    <li class="page-item"><a class="page-link" href="#">Prev</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                                    <li class="page-item"><span class="page-link"><em class="icon ni ni-more-h"></em></span></li>
                                                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                                                    <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                                </ul><!-- .pagination -->
                                            </div>
                                            <div class="nk-add-product toggle-slide toggle-slide-right" data-content="addProduct" data-toggle-screen="any" data-toggle-overlay="true" data-toggle-body="true" data-simplebar>
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">New Invoice</h5>
                                            <div class="nk-block-des">
                                                <p>Add information and add new Invoice</p>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block-head -->
                                    <div class="nk-block">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="product-title">Invoice Title</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="product-title">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="regular-price">Regular Price</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" class="form-control" id="regular-price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="sale-price">Sale Price</label>
                                                    <div class="form-control-wrap">
                                                        <input type="number" class="form-control" id="sale-price">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="stock">Stock</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="stock">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="SKU">SKU</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="SKU">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="category">Category</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="category">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="tags">Tags</label>
                                                    <div class="form-control-wrap">
                                                        <input type="text" class="form-control" id="tags">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                            
                                                <label class="form-label" for="file">Select Image to upload:</label>
                                                <input type="file" class="form-control" id="image" name="ticket_image" required>
                                            
                                            </div>
                                            <div class="col-12">
                                                <button class="btn btn-primary"><em class="icon ni ni-plus"></em><span>Add New</span></button>
                                            </div>
                                        </div>
                                    </div><!-- .nk-block -->
                                </div><!-- .card-inner -->
                                        </div><!-- .card-inner-group -->
                                    </div><!-- .card -->
                                </div><!-- .nk-block -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content @e -->
                <!-- footer @s -->
                <?php
include('layout/footer.php');
?>