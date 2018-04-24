<div class="cont">
  <section id="sec1">
    <div class="row">
      <div class="col-md-3">
        <ul>
          <li><a href="<?php echo base_url();?>#page-top">Home</a></li>
          <li><a href="<?php echo base_url();?>#about">About</a></li>
          <li><a href="<?php echo base_url();?>#courses">Courses</a></li>
          <li><a href="<?php echo base_url();?>#portfolio">Portfolio</a></li>
          <li><a href="<?php echo base_url();?>#contact">Contact</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul>
          <li><?= anchor('courses/foundation', 'Foundation College')?></li>
          <li><?= anchor('courses/technical', 'Technical College')?></li>
          <li><?= anchor('courses/university', 'University College')?></li>
          <li><?= anchor('courses/part_time', 'Part-Time Courses')?></li>
        </ul>
      </div>
      <div class="col-md-3">
        <ul>
          <li><a href="index.php?/Login/login_validation">Login</a></li>
          <li><a href="#">Logout</a></li>
          <!--<li><a href="#">Clients</a></li>
          <li><a href="#">Contact Us</a></li>-->
        </ul>
      </div>

     <!-- <div class="col-md-3">
        <ul>
          <li><a href="#">Home</a></li>
          <li><a href="#">About</a></li>
          <li><a href="#">Clients</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
    </div>-->
    </div>
  </section>
</div>
<!-- /container -->

  </body>

</html>
