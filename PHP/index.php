<?php

include('connect.php');

  if (isset($_POST['login']))
  {

        $errors = array();
        $email = $_POST['emaill'];
        $pass = $_POST['pass'];

        if(empty($email))
        {
            $errors['email'] = "Insert an email of phone";   
        }
        
        if(empty($pass))
        {
            $errors['pass'] = "Insert a password";
        }

        if(count($errors) == 0)
        {
            $query = "select email,contact,password from user where ((email = '$email' OR contact = '$email') AND password='$pass')";                
            
            $result = mysqli_query($conn,$query);
            
            if(mysqli_num_rows($result) == 0)
            {
                $errors['login'] = "Username and Password doesn't match.";
            }
            else
            {
                while($row=mysqli_fetch_assoc($result))
                {
                    if(($row["email"] === $email || $row["contact"] === $email ) && $row["Password"] === $password)
                    {
                        session_start();
                        
                        $_SESSION['puser'] = $email;

                        header("Location:home.php");   
                    }
                }

                $errors['login'] = "Username and Password doesn't match.";     
            }

           
        }
  }
  if(isset($_POST['register']))
  {
        $errors = array();
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $cpass=$_POST['cpass'];
        $city=$_POST['city'];
        $area=$_POST['area'];
        $phone=$_POST['phone'];
        $bgroup=$_POST['bgroup'];
        $gender=$_POST['gender'];
        $day=$_POST['day'];
        $month=$_POST['month'];
        $year=$_POST['year'];

        //start validation
        if(empty($fname))
        {
            $errors['fname1'] = "Your first name cannot be empty";
        }
        else if(strlen($fname) < 2)
        {
            $errors['fname2'] = "Your first name must be atleast 2 characters long";
        }

        if(empty($lname))
        {
            $errors['lname1'] = "Your last name cannot be empty";
        }
        else if(strlen($lname) < 2)
        {
            $errors['lname2'] = "Your last name must be atleast 2 characters long";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
        {
             $errors['email1'] = "Invalid email format"; 
        }
        else
        {
            $query = "select * from user where email='$email'";                
            
            $result = mysqli_query($conn,$query);
             
            if(mysqli_num_rows($result) > 0)
            {
                $errors['email2'] = "Email Taken";       
            }
        }
        
        if(empty($pass))
        {
            $errors['pass1'] = "Password cannot be empty";
        }
        else if(strlen($pass) < 6)
        {
            $errors['pass2'] = "Password must be atlest 6 characters long";
        }
        else if(strlen($pass) > 32)
        {
            $errors['pass3'] = "Password can be maximum of 32 character";
        }
        else
        {
            $tpass=count_chars($pass,1);

            $ch=$sp=$dg=0;

            foreach ($tpass as $key => $value) {
                if($key >= 33 && $key <= 47)
                {
                    $sp=1;
                }
                else if($key >= 58 && $key <= 64)
                {
                    $sp=1;
                }
                else if($key >= 91 && $key <= 96)
                {
                    $sp=1;
                }
                else if($key >= 123 && $key <= 126)
                {
                    $sp=1;
                }
                else if($key >= 48 && $key <= 57)
                {
                    $dg=1;
                }
                else if($key >= 65 && $key <= 90)
                {
                    $ch=1;
                }
                else if($key >= 97 && $key <= 122)
                {
                    $ch=1;
                }

            }

            if($sp==0 || $dg ==0 || $ch==0)
            {
                $errors['pass4'] = "Password must contain a digit, a letter and a special cheracter";
            }
        }

        if(empty($cpass))
        {
            $errors['cpass1'] = "Please Confirm the password";
        }
        else if ($cpass !== $pass) 
        {
             $errors['cpass2'] = "Password Doesn't match"; 
        }

        if(empty($city))
        {
            $errors['city'] = "Please enter a city";
        }

        if(empty($area))
        {
            $errors['area'] = "Please enter a area";
        }

        if(empty($phone))
        {
            $errors['phone1'] = "Please enter a contact number";
        }
        else if(strlen($phone) != 11)
        {
            $errors['phone2'] = "Please enter a valid contuct info";
        }
        else
        {
            $query = "select * from user where contact='$phone'";                
            
            $result = mysqli_query($conn,$query);
             
            if(mysqli_num_rows($result) > 0)
            {
                $errors['phone3'] = "Contact number Taken";       
            }
        }

        if(empty($bgroup))
        {
            $errors['bgroup'] = "Please select a blood group";
        }

        if (empty($gender)) 
        {
             $errors['gender'] = "Please select a gender";
        }

        if(empty($day) || empty($month) || empty($year))
        {
            $errors['dob'] = "Insert a valid date of birth";
        }

        //check errors
        if(count($errors) == 0)
        {
            $dob = $year . "-" . $month . "-" . $day;

            $query = "insert into user (fname,lname,email,password,bgroup,gender,dob,city,area,contact) values('$fname','$lname','$email','$pass','$bgroup','$gender','$dob','$city','$area','$phone')";                
            
            $result = mysqli_query($conn,$query);

            if($result)
            { 
            	session_start();
                        
                $_SESSION['puser'] = $email;

                header("Location:profile.php");     
            } 
            else 
            {
                $msg =mysqli_error($conn);
                echo '<script>alert("'.$msg.'");</script>';
            }
        }
  }
?>

<!DOCTYPE html>
<html>
<head>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Facebook Style Home Page Design - demo by w3lessons.info</title>
  <link rel="stylesheet" href="style.css" type="text/css" />
</head>

<body class="login">
  <!-- header starts here -->
  <div id="facebook-Bar">
    <div id="facebook-Frame">
      <div id="logo"></a> </div> <!--problem -->

      <!--Log in Part -->
      <div id="header-main-right">
        <div id="header-main-right-nav">
          <form method="post" action="" id="login" name="login">
            <table border="0" style="border:none">
              <tr>
                <td ><input type="text" tabindex="1"  id="emaill" placeholder="Email or Phone" name="emaill" class="inputtext radius1" value="<?php if(isset($_POST['emaill'])) echo $_POST['emaill'];?>"/></td>

                <td ><input type="password" tabindex="2" id="pass" placeholder="Password" name="pass" class="inputtext radius1" /></td>

                <td ><input type="submit" class="fbbutton" name="login" value="Login" /></td>
              </tr>

              <p><?php if(isset($errors['login'])) echo '<script>alert("Email and Password does not match");</script>'; ?></p>

              <tr>
                <td><label><input id="persist_box" type="checkbox" name="persistent" value="1" checked="1"/><span style="color:#ccc;">Keep me logged in</span></label>
                </td>
                <td><label><a href="" style="color:#ccc; text-decoration:none">forgot your password?</a></label></td>
              </tr>
            </table>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- header ends here -->
  <!--Log in ends here -->

  <!--Registration form starts here-->

  <div class="loginbox radius">
    <h2 style="color:#141823; text-align:center;">Welcome</h2>
    <div class="loginboxinner radius">
      <div class="loginheader">
        <h4 class="title">Connect With Blood Donors All Over The World</h4>
      </div><!--loginheader-->

      <div class="loginform">
       <form id="register" name="register" action="" method="post">
        <p>
          <input type="text" id="fname" name="fname" placeholder="First Name" value="<?php if(isset($_POST['fname'])) echo $_POST['fname'];?>" class="radius mini" />

          <input type="text" id="lname" name="lname" placeholder="Last Name" value="<?php if(isset($_POST['lname'])) echo $_POST['lname'];?>" class="radius mini" />
        </p>

        <p><?php if(isset($errors['fname1'])) echo $errors['fname1']; ?></p>
        <p><?php if(isset($errors['fname2'])) echo $errors['fname2']; ?></p>
        <p><?php if(isset($errors['lname1'])) echo $errors['lname1']; ?></p>
        <p><?php if(isset($errors['lname2'])) echo $errors['lname2']; ?></p>

        <p>
          <input type="text" id="email" name="email" placeholder="Your Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>" class="radius" />
        </p>

        <p><?php if(isset($errors['email1'])) echo $errors['email1']; ?></p>
        <p><?php if(isset($errors['email2'])) echo $errors['email2']; ?></p>

        <p>
          <input type="password" id="pass" name="pass" placeholder="Password" class="radius" />
        </p>

        <p><?php if(isset($errors['pass1'])) echo $errors['pass1']; ?></p>
        <p><?php if(isset($errors['pass2'])) echo $errors['pass2']; ?></p>
        <p><?php if(isset($errors['pass3'])) echo $errors['pass3']; ?></p>
        <p><?php if(isset($errors['pass4'])) echo $errors['pass4']; ?></p>

        <p>
          <input type="password" id="cpass" name="cpass" placeholder="Confirm Password" class="radius" />
        </p>

        <p><?php if(isset($errors['cpass1'])) echo $errors['cpass1']; ?></p>
        <p><?php if(isset($errors['cpass2'])) echo $errors['cpass2']; ?></p>

        <p>
          <input type="text" id="city" name="city" placeholder="City" value="<?php if(isset($_POST['city'])) echo $_POST['city'];?>" class="radius mini" />

          <input type="text" id="area" name="area" placeholder="Area" value="<?php if(isset($_POST['area'])) echo $_POST['area'];?>" class="radius mini" />
        </p>

        <p><?php if(isset($errors['city'])) echo $errors['city']; ?></p>
        <p><?php if(isset($errors['area'])) echo $errors['area']; ?></p>

        <p>
          <input type="text" id="phone" name="phone" placeholder="Contact No" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>" class="radius" />
        </p>

        <p><?php if(isset($errors['phone1'])) echo $errors['phone1']; ?></p>
        <p><?php if(isset($errors['phone2'])) echo $errors['phone2']; ?></p>
        <p><?php if(isset($errors['phone3'])) echo $errors['phone3']; ?></p>

        <p>
          <select name="bgroup" class="select1">
            <option value="">Please Select Your Blood Group</option>
            <option value="O-">O-</option>
            <option value="O+">O+</option>
            <option value="A-">A-</option>
            <option value="A+">A+</option>
            <option value="B-">B-</option>
            <option value="B+">B+</option>
            <option value="AB-">AB-</option>
            <option value="AB+">AB+</option>
          </select>
        </p>

        <p><?php if(isset($errors['bgroup'])) echo $errors['bgroup']; ?></p>

        <p>
          <select name="gender" class="select2">
            <option value="">Select Your Gender</option>
            <option value="male">Male</option>
            <option value="Female">Female</option>
            <option value="other">Other</option>
          </select>
        </p>

        <p><?php if(isset($errors['gender'])) echo $errors['gender']; ?></p>

        <p>
          <label for="day" class="control-label">Date of birth</label>
          <select name="day" id="day" class="select3">
            <option value="">Day</option>
            <option value="">---</option>
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
            <option value="13">13</option>
            <option value="14">14</option>
            <option value="15">15</option>
            <option value="16">16</option>
            <option value="17">17</option>
            <option value="18">18</option>
            <option value="19">19</option>
            <option value="20">20</option>
            <option value="21">21</option>
            <option value="22">22</option>
            <option value="23">23</option>
            <option value="24">24</option>
            <option value="25">25</option>
            <option value="26">26</option>
            <option value="27">27</option>
            <option value="28">28</option>
            <option value="29">29</option>
            <option value="30">30</option>
            <option value="31">31</option>
          </select>
          <select name="month" id="month" class="select3">
            <option value="">Month</option>
            <option value="">-----</option>
            <option value="01">January</option>
            <option value="02">February</option>
            <option value="03">March</option>
            <option value="04">April</option>
            <option value="05">May</option>
            <option value="06">June</option>
            <option value="07">July</option>
            <option value="08">August</option>
            <option value="09">September</option>
            <option value="10">October</option>
            <option value="11">November</option>
            <option value="12">December</option>
          </select>
          <select name="year" id="year" class="select3">
            <option value="">Year</option>
            <option value="">----</option>
            <option value="2012">2012</option>
            <option value="2011">2011</option>
            <option value="2010">2010</option>
            <option value="2009">2009</option>
            <option value="2008">2008</option>
            <option value="2007">2007</option>
            <option value="2006">2006</option>
            <option value="2005">2005</option>
            <option value="2004">2004</option>
            <option value="2003">2003</option>
            <option value="2002">2002</option>
            <option value="2001">2001</option>
            <option value="2000">2000</option>
            <option value="1999">1999</option>
            <option value="1998">1998</option>
            <option value="1997">1997</option>
            <option value="1996">1996</option>
            <option value="1995">1995</option>
            <option value="1994">1994</option>
            <option value="1993">1993</option>
            <option value="1992">1992</option>
            <option value="1991">1991</option>
            <option value="1990">1990</option>
            <option value="1989">1989</option>
            <option value="1988">1988</option>
            <option value="1987">1987</option>
            <option value="1986">1986</option>
            <option value="1985">1985</option>
            <option value="1984">1984</option>
            <option value="1983">1983</option>
            <option value="1982">1982</option>
            <option value="1981">1981</option>
            <option value="1980">1980</option>
            <option value="1979">1979</option>
            <option value="1978">1978</option>
            <option value="1977">1977</option>
            <option value="1976">1976</option>
            <option value="1975">1975</option>
            <option value="1974">1974</option>
            <option value="1973">1973</option>
            <option value="1972">1972</option>
            <option value="1971">1971</option>
            <option value="1970">1970</option>
            <option value="1969">1969</option>
            <option value="1968">1968</option>
            <option value="1967">1967</option>
            <option value="1966">1966</option>
            <option value="1965">1965</option>
            <option value="1964">1964</option>
            <option value="1963">1963</option>
            <option value="1962">1962</option>
            <option value="1961">1961</option>
            <option value="1960">1960</option>
            <option value="1959">1959</option>
            <option value="1958">1958</option>
            <option value="1957">1957</option>
            <option value="1956">1956</option>
            <option value="1955">1955</option>
            <option value="1954">1954</option>
            <option value="1953">1953</option>
            <option value="1952">1952</option>
            <option value="1951">1951</option>
            <option value="1950">1950</option>
            <option value="1949">1949</option>
            <option value="1948">1948</option>
            <option value="1947">1947</option>
            <option value="1946">1946</option>
            <option value="1945">1945</option>
            <option value="1944">1944</option>
            <option value="1943">1943</option>
            <option value="1942">1942</option>
            <option value="1941">1941</option>
            <option value="1940">1940</option>
            <option value="1939">1939</option>
            <option value="1938">1938</option>
            <option value="1937">1937</option>
            <option value="1936">1936</option>
            <option value="1935">1935</option>
            <option value="1934">1934</option>
            <option value="1933">1933</option>
            <option value="1932">1932</option>
            <option value="1931">1931</option>
            <option value="1930">1930</option>
            <option value="1929">1929</option>
            <option value="1928">1928</option>
            <option value="1927">1927</option>
            <option value="1926">1926</option>
            <option value="1925">1925</option>
            <option value="1924">1924</option>
            <option value="1923">1923</option>
            <option value="1922">1922</option>
            <option value="1921">1921</option>
            <option value="1920">1920</option>
            <option value="1919">1919</option>
            <option value="1918">1918</option>
            <option value="1917">1917</option>
            <option value="1916">1916</option>
            <option value="1915">1915</option>
            <option value="1914">1914</option>
            <option value="1913">1913</option>
            <option value="1912">1912</option>
            <option value="1911">1911</option>
            <option value="1910">1910</option>
            <option value="1909">1909</option>
            <option value="1908">1908</option>
            <option value="1907">1907</option>
            <option value="1906">1906</option>
            <option value="1905">1905</option>
            <option value="1904">1904</option>
            <option value="1903">1903</option>
            <option value="1901">1901</option>
            <option value="1900">1900</option>
          </select>
        </p>

        <p><?php if(isset($errors['dob'])) echo $errors['dob']; ?></p>

        <p>
         <input type="submit" class="fbbutton" name="register" value="Sign Up for Blood Assistant">
        </p>
     </form>
   </div><!--loginform-->
 </div><!--loginboxinner-->
</div><!--loginbox-->

<!--Registration form ends here-->


</body>

</html>
