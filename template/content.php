 <div class="card bg-transparent">
<article class="card-body mx-auto" style="max-width: 400px;">
  <img src="images/uits.png" width="200" height="100" class="rounded mx-auto d-block" alt="">
  <h4 class="card-title mt-3 text-center">Create Account</h4>
  <p class="text-center">Get started with your account</p>
    </p>
    <p class="text-center"> Register Once </p>
    </p>
  <form action="" method="post">
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
     </div>
        <input class="form-control" placeholder="Full name" type="text" name="u_name" required="required">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
        <input class="form-control" placeholder="Email address" type="email" name="u_email" required="required">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fas fa-venus-mars"></i> </span>
    </div>
    <select class="form-control" name="u_gender">
        <option selected="">Male</option>
        <option value="1">Female</option>
    </select>
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-building"></i> </span>
    </div>
    <select class="form-control" name="u_department">
       <option selected="">Select Your Department</option>
                <option>CSE</option>
                <option>IT</option>
                <option>CE</option>
                <option>BBA</option>
                <option>EEE</option>
                <option>ENGLISH</option>
                <option>LAW</option>
                <option>PHARMACY</option>
                <option>OTHERS</option>
    </select>
  </div> <!-- form-group end.// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input class="form-control" type="password" name="u_pass" required="required" placeholder="Enter your password">
    </div> <!-- form-group// -->
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fas fa-birthday-cake"></i> </span>
    </div>
        <input class="form-control" type="date" name="u_birthday" required="required">
    </div> <!-- form-group// -->                                     
    <div class="form-group">
        <button type="submit" name="sign_up" class="btn btn-primary btn-block"> Create Account  </button>
    </div> <!-- form-group// -->      
    <p class="text-center">Have an account already? Log In From top </p>     

</form>
</article>
<?php include("insert_user.php")  ?>
</div> <!-- card.// -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>