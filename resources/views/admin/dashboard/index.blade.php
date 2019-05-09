@extends('admin.layouts.app')

@section('after-style')
@endsection('after-style')

@section('left-breadcrumb')
<div class="rjadmin_back"><a href="{{ route('landing') }}">Back to myThereo</a></div>
@endsection('left-breadcrumb')

@section('content')
<!-- Start Navigation -->
<div class="rjadmin_navigation">
    <ul class="menu_tab nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#menu-tab">Menu</a></li>
        <li><a data-toggle="tab" href="#msg-tab">Messages</a></li>
        <li><a data-toggle="tab" href="#notific-tab">Notifications</a></li>
        <li class="rightside"><a data-toggle="tab" href="#analytic-tab">Analytics</a></li>

    </ul>

    <div class="tab-content">
        <div id="menu-tab" class="tab-pane fade in active">
            <div class="admin-nav-head">Where you would like to go? Select one of the options below.</div>
            <ul class="navi_list">
                <li class="navi_header"><a href="javascript:void(0)">Products</a></li>
                <li><a href="{{ route('admin.article.list') }}">Articles</a></li>
                <li><a href="{{ route('admin.program.list') }}">Programs</a></li>
                <li><a href="javascript:void(0)">Merchandise</a></li>
            </ul>

            <ul class="navi_list">
                <li class="navi_header"><a href="javascript:void(0)">Relations</a></li>
                <li><a href="javascript:void(0)">Users</a></li>
                <li><a href="javascript:void(0)">Announcements</a></li>
                <li><a href="javascript:void(0)">Responders</a></li>
            </ul>

            <ul class="navi_list">
                <li class="navi_header"><a href="javascript:void(0)">Settings</a></li>
                <li><a href="javascript:void(0)">Media</a></li>
                <li><a href="javascript:void(0)">Pages</a></li>
                <li><a href="javascript:void(0)">Security</a></li>
                <li><a href="javascript:void(0)">Optimization</a></li>
                <li><a href="javascript:void(0)">Navigation</a></li>
                <li><a href="javascript:void(0)">Commerce</a></li>
                <li><a href="javascript:void(0)">Access</a></li>
            </ul>
        </div>
        <div id="msg-tab" class="tab-pane fade in">
            <div class="admin-nav-head">The following messages come from those that use the website's contact forms.</div>
            <div id="filter">
                <div class="filter_hd">
                    <p>You may search, filter, and edit the messages below.</p>
                    <!-- <a href="javascript:void(0)" class="nw_article">New Article</a> -->
                </div>
                <div class="filter_option">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-9">
                            <input type="text" value="" placeholder="Search">
                            <select>
                                <option>Filter</option>
                            </select>
                            <p>100 Messages</p>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                            <select>
                                <option>Actions</option>
                            </select>
                            <a class="conf_btn" href="javascript:void(0)">Confirm</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="responder_table">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </th>
                                            <th>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Subject <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Author <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="" value="">
                                                        <i class="helper"></i>
                                                    </label>
                                                </div>
                                            </td>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Feedback</td>
                                            <td>Bradly Mence</td>
                                            <td>18/07/22</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="notific-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Notifications alert you about important activities that you may want to know about.
                <a href="javascript:void(0)">Change Settings</a></div>
            <section id="filter">
                <div class="filter_hd">
                    <p>You may search and filter the notifications below.</p>
                    <!-- <a href="javascript:void(0)" class="nw_article">New Article</a> -->
                </div>
                <div class="filter_option">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <input type="text" value="" placeholder="Search">
                            <select>
                                <option>Filter</option>
                            </select>
                            <p>100 Notifications</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <div class="responder_table notifications">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Title <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Category <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Date <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                            <th>Time <i class="fa fa-long-arrow-up" aria-hidden="true"></i><i class="fa fa-long-arrow-down" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Message</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Usre</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Merchandise</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Message</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Message</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Message</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                        <tr>
                                            <td>Lorem ipsum dolor sit amet</td>
                                            <td>Message</td>
                                            <td>18/07/22</td>
                                            <td>1:52 PM</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div id="analytic-tab" class="tab-pane fade in">
            <div class="admin-nav-head">Analytics provides details about how your audience responds to, and interacts with, your website in general.

            </div>
        </div>

    </div>
    <!-- Start Navigation -->
</div>
@endsection('content')

@section('after-script')
@endsection('after-script')
