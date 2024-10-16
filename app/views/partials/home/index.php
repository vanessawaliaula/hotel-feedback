<?php 
$page_id = null;
$comp_model = new SharedController;
$current_page = $this->set_current_page_link();
?>
<div>
    <div  class="bg-light p-3 mb-3">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                    <h4 >Sentimental Analysis Tool For Hotel Feedback System</h4>
                </div>
            </div>
        </div>
    </div>
    <div  class="">
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid">
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_feedback();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("feedback/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-comments fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Feedback</div>
                                    <small class="">Feedback from clients</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_branches();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("branches/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-bank fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Branches</div>
                                    <small class="">Available branches</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 comp-grid">
                    <?php $rec_count = $comp_model->getcount_departments();  ?>
                    <a class="animated zoomIn record-count card bg-light text-dark"  href="<?php print_link("departments/") ?>">
                        <div class="row">
                            <div class="col-2">
                                <i class="fa fa-cutlery fa-2x"></i>
                            </div>
                            <div class="col-10">
                                <div class="flex-column justify-content align-center">
                                    <div class="title">Departments</div>
                                    <small class="">Hotel departments</small>
                                </div>
                            </div>
                            <h4 class="value"><strong><?php echo $rec_count; ?></strong></h4>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
