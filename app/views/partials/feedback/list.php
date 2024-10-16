<?php
$comp_model = new SharedController;
$page_element_id = "list-page-" . random_str();
$current_page = $this->set_current_page_link();
$csrf_token = Csrf::$token;
//Page Data From Controller
$view_data = $this->view_data;
$records = $view_data->records;
$record_count = $view_data->record_count;
$total_records = $view_data->total_records;
$field_name = $this->route->field_name;
$field_value = $this->route->field_value;
$view_title = $this->view_title;
$show_header = $this->show_header;
$show_footer = $this->show_footer;
$show_pagination = $this->show_pagination;
?>
<section class="page" id="<?php echo $page_element_id; ?>" data-page-type="list"  data-display-type="table" data-page-url="<?php print_link($current_page); ?>">
    <?php
    if( $show_header == true ){
    ?>
    <div  class="bg-light p-3 mb-3">
        <div class="container-fluid">
            <div class="row ">
                <div class="col ">
                    <h4 class="record-title">Customer Feedback</h4>
                </div>
                <div class="col-sm-3 ">
                    <a  class="btn btn btn-primary my-1" href="<?php print_link("feedback/add") ?>">
                        <i class="fa fa-plus"></i>                              
                        Submit New Feedback 
                    </a>
                </div>
                <div class="col-sm-4 ">
                    <form  class="search" action="<?php print_link('feedback'); ?>" method="get">
                        <div class="input-group">
                            <input value="<?php echo get_value('search'); ?>" class="form-control" type="text" name="search"  placeholder="Search" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-12 comp-grid">
                        <div class="">
                            <!-- Page bread crumbs components-->
                            <?php
                            if(!empty($field_name) || !empty($_GET['search'])){
                            ?>
                            <hr class="sm d-block d-sm-none" />
                            <nav class="page-header-breadcrumbs mt-2" aria-label="breadcrumb">
                                <ul class="breadcrumb m-0 p-1">
                                    <?php
                                    if(!empty($field_name)){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('feedback'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">
                                        <?php echo (get_value("tag") ? get_value("tag")  :  make_readable($field_name)); ?>
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold">
                                        <?php echo (get_value("label") ? get_value("label")  :  make_readable(urldecode($field_value))); ?>
                                    </li>
                                    <?php 
                                    }   
                                    ?>
                                    <?php
                                    if(get_value("search")){
                                    ?>
                                    <li class="breadcrumb-item">
                                        <a class="text-decoration-none" href="<?php print_link('feedback'); ?>">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item text-capitalize">
                                        Search
                                    </li>
                                    <li  class="breadcrumb-item active text-capitalize font-weight-bold"><?php echo get_value("search"); ?></li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </nav>
                            <!--End of Page bread crumbs components-->
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        ?>
        <div  class="">
            <div class="container-fluid">
                <div class="row ">
                    <div class="col-md-12 comp-grid">
                    </div>
                    <div class="col-md-2 comp-grid">
                        <form method="get" action="<?php print_link($current_page) ?>" class="form filter-form">
                            <div class="card mb-3">
                                <div class="card-header h4 h4">Visit Date</div>
                                <div class="p-2">
                                    <input class="form-control datepicker"  value="<?php echo $this->set_field_value('feedback_visit_date') ?>" type="datetime"  name="feedback_visit_date" placeholder="" data-enable-time="" data-date-format="Y-m-d" data-alt-format="M j, Y" data-inline="false" data-no-calendar="false" data-mode="range" />
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Department</div>
                                    <div class="p-2">
                                        <select   name="feedback_department" class="form-control custom ">
                                            <option value="">Select ...</option>
                                            <?php 
                                            $feedback_department_options = $comp_model -> feedback_feedbackdepartment_option_list();
                                            if(!empty($feedback_department_options)){
                                            foreach($feedback_department_options as $option){
                                            $value = (!empty($option['value']) ? $option['value'] : null);
                                            $label = (!empty($option['label']) ? $option['label'] : $value);
                                            $selected = $this->set_field_selected('feedback_department',$value);
                                            ?>
                                            <option <?php echo $selected; ?> value="<?php echo $value; ?>">
                                                <?php echo $label; ?>
                                            </option>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header h4 h4">Rating</div>
                                    <div class="p-2">
                                        <?php 
                                        $feedback_rating_options = $comp_model -> feedback_feedbackrating_option_list();
                                        if(!empty($feedback_rating_options)){
                                        foreach($feedback_rating_options as $option){
                                        $value = (!empty($option['value']) ? $option['value'] : null);
                                        $label = (!empty($option['label']) ? $option['label'] : $value);
                                        $checked = $this->set_field_checked('feedback_rating', $value);
                                        ?>
                                        <label class="custom-control custom-radio custom-control-inline">
                                            <input id="" class="custom-control-input" <?php echo $checked; ?> value="<?php echo $value; ?>" type="radio"  name="feedback_rating"  />
                                                <span class="custom-control-label"><?php echo $label; ?></span>
                                            </label>
                                            <?php
                                            }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <hr />
                                    <div class="form-group text-center">
                                        <button class="btn btn-primary">Filter</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-10 comp-grid">
                                <?php $this :: display_page_errors(); ?>
                                <div class="filter-tags mb-2">
                                    <?php
                                    if(!empty($_GET['feedback_visit_date'])){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Feedback Visit Date :</b> 
                                        <?php
                                        $date_val = get_value('feedback_visit_date');
                                        $formated_date = "";
                                        if(str_contains('-to-', $date_val)){
                                        //if value is a range date
                                        $vals = explode('-to-' , str_replace(' ' , '' , $date_val));
                                        $startdate = $vals[0];
                                        $enddate = $vals[1];
                                        $formated_date = format_date($startdate, 'jS F, Y') . ' <span class="text-muted">&#10148;</span> ' . format_date($enddate, 'jS F, Y');
                                        }
                                        elseif(str_contains(',', $date_val)){
                                        //multi date values
                                        $vals = explode(',' , str_replace(' ' , '' , $date_val));
                                        $formated_arrs = array_map(function($date){return format_date($date, 'jS F, Y');}, $vals);
                                        $formated_date = implode(' <span class="text-info">&#11161;</span> ', $formated_arrs);
                                        }
                                        else{
                                        $formated_date = format_date($date_val, 'jS F, Y');
                                        }
                                        echo  $formated_date;
                                        $remove_link = unset_get_value('feedback_visit_date', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('feedback_department'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Department :</b> 
                                        <?php 
                                        if(get_value('feedback_departmentlabel')){
                                        echo get_value('feedback_departmentlabel');
                                        }
                                        else{
                                        echo get_value('feedback_department');
                                        }
                                        $remove_link = unset_get_value('feedback_department', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                    <?php
                                    if(!empty(get_value('feedback_rating'))){
                                    ?>
                                    <div class="filter-chip card bg-light">
                                        <b>Rating :</b> 
                                        <?php 
                                        if(get_value('feedback_ratinglabel')){
                                        echo get_value('feedback_ratinglabel');
                                        }
                                        else{
                                        echo get_value('feedback_rating');
                                        }
                                        $remove_link = unset_get_value('feedback_rating', $this->route->page_url);
                                        ?>
                                        <a href="<?php print_link($remove_link); ?>" class="close-btn">
                                            &times;
                                        </a>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div  class=" animated fadeIn page-content">
                                    <div id="feedback-list-records">
                                        <div id="page-report-body" class="table-responsive">
                                            <table class="table  table-striped table-sm text-left">
                                                <thead class="table-header bg-light">
                                                    <tr>
                                                        <th class="td-sno">#</th>
                                                        <th  class="td-customer_name"> Customer Name</th>
                                                        <th  class="td-customer_phone"> Customer Phone</th>
                                                        <th  class="td-customer_email"> Customer Email</th>
                                                        <th  class="td-visit_date"> Visit Date</th>
                                                        <th  class="td-department"> Department</th>
                                                        <th  class="td-rating"> Rating</th>
                                                        <th  class="td-hotel_branch"> Hotel Branch</th>
                                                        <th class="td-btn"></th>
                                                    </tr>
                                                </thead>
                                                <?php
                                                if(!empty($records)){
                                                ?>
                                                <tbody class="page-data" id="page-data-<?php echo $page_element_id; ?>">
                                                    <!--record-->
                                                    <?php
                                                    $counter = 0;
                                                    foreach($records as $data){
                                                    $rec_id = (!empty($data['id']) ? urlencode($data['id']) : null);
                                                    $counter++;
                                                    ?>
                                                    <tr>
                                                        <th class="td-sno"><?php echo $counter; ?></th>
                                                        <td class="td-customer_name"> <?php echo $data['customer_name']; ?></td>
                                                        <td class="td-customer_phone"><a href="<?php print_link("tel:$data[customer_phone]") ?>"><?php echo $data['customer_phone']; ?></a></td>
                                                        <td class="td-customer_email"><a href="<?php print_link("mailto:$data[customer_email]") ?>"><?php echo $data['customer_email']; ?></a></td>
                                                        <td class="td-visit_date"> <?php echo $data['visit_date']; ?></td>
                                                        <td class="td-department"> <?php echo $data['department']; ?></td>
                                                        <td class="td-rating"> <?php echo $data['rating']; ?></td>
                                                        <td class="td-hotel_branch"> <?php echo $data['hotel_branch']; ?></td>
                                                        <th class="td-btn">
                                                            <a class="btn btn-sm btn-success has-tooltip" title="View Record" href="<?php print_link("feedback/view/$rec_id"); ?>">
                                                                <i class="fa fa-eye"></i> View
                                                            </a>
                                                            <a class="btn btn-sm btn-info has-tooltip" title="Edit This Record" href="<?php print_link("feedback/edit/$rec_id"); ?>">
                                                                <i class="fa fa-edit"></i> Edit
                                                            </a>
                                                        </th>
                                                    </tr>
                                                    <?php 
                                                    }
                                                    ?>
                                                    <!--endrecord-->
                                                </tbody>
                                                <tbody class="search-data" id="search-data-<?php echo $page_element_id; ?>"></tbody>
                                                <?php
                                                }
                                                ?>
                                            </table>
                                            <?php 
                                            if(empty($records)){
                                            ?>
                                            <h4 class="bg-light text-center border-top text-muted animated bounce  p-3">
                                                <i class="fa fa-ban"></i> No record found
                                            </h4>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if( $show_footer && !empty($records)){
                                        ?>
                                        <div class=" border-top mt-2">
                                            <div class="row justify-content-center">    
                                                <div class="col-md-auto justify-content-center">    
                                                    <div class="p-3 d-flex justify-content-between">    
                                                        <div class="dropup export-btn-holder mx-1">
                                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-save"></i> Export
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <?php $export_print_link = $this->set_current_page_link(array('format' => 'print')); ?>
                                                                <a class="dropdown-item export-link-btn" data-format="print" href="<?php print_link($export_print_link); ?>" target="_blank">
                                                                    <img src="<?php print_link('assets/images/print.png') ?>" class="mr-2" /> PRINT
                                                                    </a>
                                                                    <?php $export_pdf_link = $this->set_current_page_link(array('format' => 'pdf')); ?>
                                                                    <a class="dropdown-item export-link-btn" data-format="pdf" href="<?php print_link($export_pdf_link); ?>" target="_blank">
                                                                        <img src="<?php print_link('assets/images/pdf.png') ?>" class="mr-2" /> PDF
                                                                        </a>
                                                                        <?php $export_word_link = $this->set_current_page_link(array('format' => 'word')); ?>
                                                                        <a class="dropdown-item export-link-btn" data-format="word" href="<?php print_link($export_word_link); ?>" target="_blank">
                                                                            <img src="<?php print_link('assets/images/doc.png') ?>" class="mr-2" /> WORD
                                                                            </a>
                                                                            <?php $export_csv_link = $this->set_current_page_link(array('format' => 'csv')); ?>
                                                                            <a class="dropdown-item export-link-btn" data-format="csv" href="<?php print_link($export_csv_link); ?>" target="_blank">
                                                                                <img src="<?php print_link('assets/images/csv.png') ?>" class="mr-2" /> CSV
                                                                                </a>
                                                                                <?php $export_excel_link = $this->set_current_page_link(array('format' => 'excel')); ?>
                                                                                <a class="dropdown-item export-link-btn" data-format="excel" href="<?php print_link($export_excel_link); ?>" target="_blank">
                                                                                    <img src="<?php print_link('assets/images/xsl.png') ?>" class="mr-2" /> EXCEL
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">   
                                                                        <?php
                                                                        if($show_pagination == true){
                                                                        $pager = new Pagination($total_records, $record_count);
                                                                        $pager->route = $this->route;
                                                                        $pager->show_page_count = true;
                                                                        $pager->show_record_count = true;
                                                                        $pager->show_page_limit =true;
                                                                        $pager->limit_count = $this->limit_count;
                                                                        $pager->show_page_number_list = true;
                                                                        $pager->pager_link_range=5;
                                                                        $pager->render();
                                                                        }
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
