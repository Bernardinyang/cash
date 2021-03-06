<?php 
  require("../includes/config.php");
  require_once(ROOT_PATH . "core/backEnd-wrapper.php");
  //Privilege Settings
  $accounting = 'false';
  $editor = 'true';
  require_once(ROOT_PATH . "core/adminSession.php");


  //
  //
  if(isset($_POST['bizName'])) {
    $bizName = strip_tags($_POST['bizName']);
    $address = strip_tags($_POST['address']);
    $city = strip_tags($_POST['city']);
    $state = strip_tags($_POST['state']);
    $country = strip_tags($_POST['country']);

    //Filter siteUlr
    $part = substr($siteUrl,0,7);
    if($part == "http://") {
      $error[] = 'Please enter recommended Site Address, Example: www.yoursite.com';
    }elseif($part == "https://"){
      $error[] = 'Please enter recommended Site Address, Example: www.yoursite.com';
    }else{
      //Check if it has www in front
      $part = substr($siteUrl,0,4);
      if($part != "www.") {
          $siteUrl = 'www.'.$siteUrl;
      }
      try {
        $stmt = $genInfo->runQuery("UPDATE website_settings 
          SET biz_name=:bizName,
              biz_addr=:address,
              biz_city=:city,
              biz_state=:state,
              biz_country=:country 
          WHERE id='1'");     
        $stmt->execute(array(':bizName'=>$bizName, ':address'=>$address, ':city'=>$city, ':state'=>$state, ':country'=>$country));
      }
      catch(PDOException $e) {
        echo $e->getMessage();
      }
      $genInfo->redirect(BASE_URL.'administrator/business-settings?updated');
      exit();
    }
  }

  $pageTitle = "Admin: Website Settings";
  $pageDesc = "Description";
  $pageKeywords = "Keywords";

  include(ROOT_PATH."administrator/includes/header.php"); 
  include(ROOT_PATH."administrator/includes/navMenu.php"); 
?>
 
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->                      
            <div class="content-page">
                <!-- Start content -->
                <div class="content">
                    <div class="container">

                        <!-- Page-Title -->
                        <div class="row">
                            <div class="col-sm-12">
                                <ol class="breadcrumb">
                                    <li><a href="<?php echo BASE_URL;?>administrator">Dashboard</a></li>
                                    <li><a href="<?php echo BASE_URL;?>administrator/website-settings">Settings</a></li>
                                    <li class="active">Business Information</li>
                                </ol>
                            </div>
                        </div>
                        
              <div class="row">
              <?php
                    if(isset($error)){
                        foreach($error as $error){?>
                         <div class="alert alert-danger">
                            <i class="fa fa-exclamation-triangle"></i> &nbsp; <?php echo $error; ?>
                         </div>
                <?php } }elseif(isset($_GET['updated'])){?>
                 <div class="alert alert-success">
                    <i class="fa fa-check-square"></i> &nbsp; Business info updated successfully!
                 </div>
            <?php }?>
							<div class="col-lg-6">
								<div class="card-box">
                <h3>Update Business Information</h3>
                <hr>
									<form action="#" method="post" action="" data-parsley-validate novalidate>
										
                    <div class="form-group">
                      <label for="bizName">Business Name*</label>
                      <input type="text" name="bizName" parsley-trigger="change" required 
                      class="form-control" id="bizName" value="<?php if(isset($siteInfo['biz_name'])){echo $siteInfo['biz_name'];}?>">
                    </div>
                    <div class="form-group">
                      <label for="address">Business Address*</label>
                      <input type="text" name="address" parsley-trigger="change" required 
                      class="form-control" id="address" value="<?php if(isset($siteInfo['biz_addr'])){echo $siteInfo['biz_addr'];}?>">
                    </div>
                    <div class="form-group">
                      <label for="city">City*</label>
                      <input type="text" name="city" parsley-trigger="change" required 
                      class="form-control" id="city" value="<?php if(isset($siteInfo['biz_city'])){echo $siteInfo['biz_city'];}?>">
                    </div>
                    <div class="form-group">
                      <label for="state">State*</label>
                      <input type="text" name="state" parsley-trigger="change" required 
                      class="form-control" id="state" value="<?php if(isset($siteInfo['biz_state'])){echo $siteInfo['biz_state'];}?>">
                    </div>
                    <div class="form-group">
                      <label for="country">Country*</label>
                      <select name="country" id="country" 
                      class="form-control">
                      <?php if(isset($country)){?>
                        <option value="<?php echo $country;?>">
                        <?php echo $country;?></option>
                      <?php }elseif($siteInfo['biz_country'] != ''){?>
                        <option value="<?php echo $siteInfo['biz_country'];?>">
                        <?php echo $siteInfo['biz_country'];?></option>
                      <?php }else{?>
                        <option>---Select---</option>
                      <?php }?>
                        <?php include(ROOT_PATH."includes/countries.php");?>
                      </select>
                    </div>
                    <br><br><br>
										<div class="form-group text-center m-b-0">
											<button class="btn btn-primary waves-effect waves-light" type="submit">
												Update
											</button>
										</div>
										
									</form>

								</div>
							</div>
							
							<div class="col-lg-6">
							</div>
						</div>
  </div> <!-- container -->             
</div> <!-- content -->

<?php include(ROOT_PATH."administrator/includes/footer.php");?>

<!-- jQuery  -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/detect.js"></script>
        <script src="assets/js/fastclick.js"></script>
        <script src="assets/js/jquery.slimscroll.js"></script>
        <script src="assets/js/jquery.blockUI.js"></script>
        <script src="assets/js/waves.js"></script>
        <script src="assets/js/wow.min.js"></script>
        <script src="assets/js/jquery.nicescroll.js"></script>
        <script src="assets/js/jquery.scrollTo.min.js"></script>

        <script src="assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
        <script src="assets/plugins/switchery/dist/switchery.min.js"></script>
        <script type="text/javascript" src="assets/plugins/multiselect/js/jquery.multi-select.js"></script>
        <script type="text/javascript" src="assets/plugins/jquery-quicksearch/jquery.quicksearch.js"></script>
        <script src="assets/plugins/select2/select2.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-select/dist/js/bootstrap-select.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-filestyle/src/bootstrap-filestyle.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
        <script src="assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

        <script src="assets/js/jquery.core.js"></script>
        <script src="assets/js/jquery.app.js"></script>


        <script>
            jQuery(document).ready(function() {

                //advance multiselect start
                $('#my_multi_select3').multiSelect({
                    selectableHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    selectionHeader: "<input type='text' class='form-control search-input' autocomplete='off' placeholder='search...'>",
                    afterInit: function (ms) {
                        var that = this,
                            $selectableSearch = that.$selectableUl.prev(),
                            $selectionSearch = that.$selectionUl.prev(),
                            selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                            selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                        that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                            .on('keydown', function (e) {
                                if (e.which === 40) {
                                    that.$selectableUl.focus();
                                    return false;
                                }
                            });

                        that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                            .on('keydown', function (e) {
                                if (e.which == 40) {
                                    that.$selectionUl.focus();
                                    return false;
                                }
                            });
                    },
                    afterSelect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    },
                    afterDeselect: function () {
                        this.qs1.cache();
                        this.qs2.cache();
                    }
                });

                // Select2
                $(".select2").select2();
                
                $(".select2-limiting").select2({
          maximumSelectionLength: 2
        });
        
         $('.selectpicker').selectpicker();
              $(":file").filestyle({input: false});
              });
              
              //Bootstrap-TouchSpin
              $(".vertical-spin").TouchSpin({
                verticalbuttons: true,
                verticalupclass: 'ion-plus-round',
                verticaldownclass: 'ion-minus-round'
            });
            var vspinTrue = $(".vertical-spin").TouchSpin({
                verticalbuttons: true
            });
            if (vspinTrue) {
                $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
            }
    
            $("input[name='demo1']").TouchSpin({
                min: 0,
                max: 100,
                step: 0.1,
                decimals: 2,
                boostat: 5,
                maxboostedstep: 10,
                postfix: '%'
            });
            $("input[name='demo2']").TouchSpin({
                min: -1000000000,
                max: 1000000000,
                stepinterval: 50,
                maxboostedstep: 10000000,
                prefix: '$'
            });
            $("input[name='demo3']").TouchSpin();
            $("input[name='demo3_21']").TouchSpin({
                initval: 40
            });
            $("input[name='demo3_22']").TouchSpin({
                initval: 40
            });
    
            $("input[name='demo5']").TouchSpin({
                prefix: "pre",
                postfix: "post"
            });
            $("input[name='demo0']").TouchSpin({});
            
            
            //Bootstrap-MaxLength
            $('input#defaultconfig').maxlength()
            
            $('input#thresholdconfig').maxlength({
                threshold: 20
            });

            $('input#moreoptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger"
            });

            $('input#alloptions').maxlength({
                alwaysShow: true,
                warningClass: "label label-success",
                limitReachedClass: "label label-danger",
                separator: ' out of ',
                preText: 'You typed ',
                postText: ' chars available.',
                validate: true
            });

            $('textarea#textarea').maxlength({
                alwaysShow: true
            });

            $('input#placement') .maxlength({
                    alwaysShow: true,
                    placement: 'top-left'
                });
        </script>


