<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>More</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
      <style>
        body {
    display: block;
    margin: 0px;
}

        .profile-block {
  width: 300px;
  background-color: #f1f1f1;
  padding: 20px;
  border-radius: 8px;
  text-align: center;
  background:none; 
  border-radius: 10px;
  backdrop-filter: blur(50px);
}

.profile-picture {
  width: 150px;
  height: 150px;
  border-radius: 50%;
  margin: 0 auto 20px;
}

.name {
  color: #333;
  font-size: 24px;
  margin-bottom: 10px;
}

.bio {
  color: #777;
  font-size: 14px;
  margin-bottom: 20px;
}

.social-links {
  list-style: none;
  padding: 0;
  margin: 0;
}

.social-links li {
  display: inline-block;
  margin-right: 10px;
}

.social-links a {
  color: #555;
  font-size: 20px;
}

.social-links a:hover {
  color: #000;
}
* {
  box-sizing: border-box;
}


.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */


table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
  color: #f1f1f1;
}

th, td {
  text-align: left;
  padding: 16px;
}


.flex-parent-element {
  display: flex;
  width: 50%;
  margin-left: 17%;
}

.flex-child-element {
  flex: 1;
  border: 2px solid blueviolet;
  margin: 10px;
}

.flex-child-element:first-child {
  margin-right: 20px;
}
form{
    background-image: url(../images/aboutUs.jpeg);
}
th{
    padding-left: 65px;
}
#first{
    font-size: 18px;
}
      </style>
    </head>
    <body >

        <form >
  
    <div class="profile-block" style="margin-left: 37%;"  >
  

  <img src="../images/faculty6470.jpg" alt="Profile Picture" class="profile-picture">
 
  <table id="first">
    <th colspan="2" >Supervisor</th>
    <tr>
        <td>Name:</td>
        <td>Naveera Sahar</td>
    </tr>
    <tr>
        <td>Designation:</td>
        <td>Lecturer</td>
    </tr>
    <tr>
        <td>Qualification::</td>
        <td rowspan="2">MS Software Engineering</td>
    </tr>
   
  </table>
  
</div> 
<div  class="flex-parent-element">
<div class="profile-block" class="flex-child-element my">
  <img src="../images/my.jpg" alt="Profile Picture" class="profile-picture">
 
  <table>
    <th colspan="2">Developer</th>
    <tr>
        <td>Name:</td>
        <td>Muhammad Awais</td>
    </tr>
    <tr>
        <td>Role:</td>
        <td>Full Stack Developer</td>
    </tr>
    <tr>
        <td>Qualification:</td>
        <td rowspan="2">BS Computer Sciences UOW</td>
    </tr>
   
  </table>
  
</div>
<div class="profile-block" class="flex-child-element green">
  <img src="../images/rr.jpeg" alt="Profile Picture" class="profile-picture">
 
  <table>
    <th colspan="2">Re-searcher</th>
    <tr>
        <td>Name:</td>
        <td>Ramish Ayaz Khan</td>
    </tr>
    <tr>
        <td>Role:</td>
        <td>Re-Searcher</td>
    </tr>
    <tr>
        <td>Qualification:</td>
        <td >BS Computer Sciences UOW</td>
    </tr>
   
  </table>
  
</div>

<div class="profile-block" class="flex-child-element my">
  <img src="../images/us.jpeg" alt="Profile Picture" class="profile-picture">
 
  <table>
    <th colspan="2">Front End Developer</th>
    <tr>
        <td>Name:</td>
        <td>Usman Khan</td>
    </tr>
    <tr>
        <td>Role:</td>
        <td>Front End Developer</td>
    </tr>
    <tr>
        <td>Qualification:</td>
        <td >BS Computer Sciences UOW</td>
    </tr>
   <tr>
    <td></td>
   </tr>
  </table>
  
</div>
</div>
        <script src="" async defer></script>
        </form>
    </body>
</html>