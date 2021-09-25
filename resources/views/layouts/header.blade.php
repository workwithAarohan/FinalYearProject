<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
    font-family: Arial, Helvetica, sans-serif;
    font-size: 15px;
    line-height:1.5em;
}

.top{
    display:flex;
    flex-direction: row;
    justify-content: space-between;
    background-color: rgb(135, 150, 235);
    box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.938);
    z-index: 1;
    margin:auto;
}
header h1{
    margin-top: 40px;
    font-size: 25px;
    color:white;
    margin-left: 20px;
}
.highlight{
    font-family: cursive;
    font-size: 15px;
    text-align: left;
}
header{
    display:flex;
    flex-direction: row;
}
nav .current  a{
    color:red;
    font-weight:bold;

}
nav a:hover{
    border-bottom: 2px blue solid;
}
header img{
    max-height: 150px;
    width: auto;
}
  

.dropdown {
    position: relative;
    display: inline-block;
}
  
.dropdown-content {
    display: none;
    position: absolute;
    background-color: rgb(135, 150, 235);
    max-width: 80px;
    margin-left: 15px;
    margin-right: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    padding: 12px 16px;
    z-index: 1;
    color:white;
    border-bottom: white 2px;
    font-size: 20px;
    line-height: 30px;
}

.dropdown:hover .dropdown-content {
    display:flex;
    flex-direction: column;
    position:absolute;
  }
  

.top ul{
    display: flex;
    justify-content:space-around;
    padding: 20px;
    margin-right: 30px;
    margin-top: 30px;

}
.top a {
    font-size: larger;
    color:white;
    padding:10px;
    margin:10px 5px;

}

a{
    text-decoration: none;
    text-transform: uppercase;
    
}


ul{
    list-style-type: none;
}
  
  .below{
      display:flex;
      flex-direction: row;
      justify-content:space-between;
  }
  footer h1{
      text-align:center;
  }
  footer{
      background-color: #d3dde6;
      color:rgba(0, 0, 0, 0.644);
      padding:20px;
      margin-top:100px;
      margin-bottom: 200px;
      box-shadow: 0px 8px 16px 0px black;
      z-index: 1;
  }
  footer a{
      color:black;
  }
  .TU{
      display:flex;
      flex-direction: row;
      align-items: center;
      justify-content: center;
      margin-top: 50px;
  }
  .TU img{
      width:80px;
      height: auto;
  }
</style>
</head>
<body>
<div class="top">
                    <header>
                        <img src="download.png" >
                        <h1>ACADEMIA INTERNATIONAL COLLEGE <br> <span class='highlight'> a destination for quality education</span></h1>
                        
                    </header>
                    <nav>
                        <ul>
                            <li class="current"><a href="index.html"> home</a></li>
                            <div class="dropdown">
                                <li><a href="courses.html"> courses</a>
                                    <div class="dropdown-content">
                                            <div>BCA</div>
                                            <div>Bsc CSIT</div>
                                            <div>BBS</div>
                                            <div>BBA</div>
                                    </div>
                                </li>
                            </div>
                        
                            <li><a href="about.html"> about us</a></li>
                            <li><a href="login.html"> login</a></li>
    
                        </ul>
                    </nav>
                </div>
        <section>

        </section>
        <aside>

        </aside>
        <aside>

        </aside>
        <footer>
            <h1>THANKS FOR VISITING US</h1>
            <div class="below">
                <div>
                    <h1>Navigation links</h1>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Gallary</a></li>
                        <li><a href="#">Application</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>

                </div>
                <div>
                    <h1>Newsletter</h1>
                    <p>Register to our newsletter and be updated<br>
                         with the latests information regarding our<br>
                          services, offers and much more.</p>
                         <div class="for">
                          <div>  <label>Email</label><br>
                            <input type="text" name="email"></div>
                         <div>  <label>name</label><br>
                            <input type="text" name="name"></div>
                         <div>  <input type="submit" name="submit" value="submit"></div>
                         </div>

                </div>
                <div>
                    <h1>Contact us</h1>
                   <p>Gwarko,lalitpur,Nepal <br>
                    Phone No:xxxxxxxxx,xxxxxxxxxx<br>
                    Website:Academia International College<br>
                    Email:info@Academia.edu.np</p>

                </div>
            </div>
            <div class="TU">
                <img src="tu-logo.png">
                <p>Affilated to Tribhuwan University </p>
            </div>
            
        </footer>
</body>
</html>