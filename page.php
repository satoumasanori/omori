<?php
get_header();
?>
<div class="auth">
  <?php the_content(); ?>
</div>

<style>
  .auth {
    width: 50%;
    padding-block: 30px;
    border: 1px solid #ddd;
    border-radius: 8px;
    margin: 0 auto;
    margin-top: 50px;
    box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
  }
  .wpmem_reg {
    margin-top: 200px;
  }

  form {
    max-width: 700px;
    margin: auto;
    padding: 20px;
  }

  legend {
    font-size: 30px;
  }

  .form-group {
    margin-bottom: 15px;
  }

  input[type="text"],
  input[type="email"],
  input[type="password"] {
    width: 100%;
    padding: 10px;
    font-size: 20px;
  }

  input[type="submit"] {
    padding: 10px 20px;
    background:rgb(63, 143, 248);
    color: white;
    border: none;
    cursor: pointer;
    font-size: 20px;
    border-radius: 7px;
  }

  input[type="submit"]:hover {
    background: #005d8f;

  }

  .text {
    font-size: 20px;
  }

  .text span {
    color: red;
  }

  .button_div {
    display: flex;
    justify-content: center;
    margin-top: 30px;
  }

 /* Style the login form layout */
.wpmem_login {
  max-width: 400px;
  margin: 0 auto;
  padding: 20px;
  border: 1px solid #ddd;
  border-radius: 8px;
  background-color: #fff;
}

/* Style individual fields */
.wpmem_login input[type="text"],
.wpmem_login input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

/* Layout for Remember Me and button */
.wpmem_login .rememberme,
.wpmem_login input[type="submit"] {
  display: block;
  margin-bottom: 10px;
}

/* Align Remember Me and login button nicely */
.wpmem_login .rememberme {
  margin-bottom: 15px;
}

.wpmem_login input[type="submit"] {
  background-color: #0073e6;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 4px;
  width: 100%;
  font-size: 16px;
  cursor: pointer;
}

.wpmem_login input[type="submit"]:hover {
  background-color: #005bb5;
}
.button_div label {
  display: flex;
  align-items: center;
}

.req-text {
  display: none;
}

.fieldset {
  border
}