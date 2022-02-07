<div class="row">
  <!--  form area -->
  <div class="col-sm-12">
    <div  class="panel panel-default thumbnail">

        <div class="panel-heading no-print">
            <div class="btn-group"> 
                <a class="btn btn-primary" href="<?= site_url("/patient") ?>"> <i class="fa fa-list"></i> Patient List</a>  
            </div>
        </div> 


        <div class="panel-body panel-form">
          <div class="row">
              <div class="col-md-9 col-sm-12 ">
                <form action=<?="/patient/update/".$patient->id ?> method="post" >
                  <?= include('form.php'); ?>
                </form>
              </div>
            <div class="col-md-3"></div>
          </div>
        </div>
    </div>
  </div>
</div>

 