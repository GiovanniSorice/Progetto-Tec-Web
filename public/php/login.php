<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../css/styleProva.css">


<link rel="icon" type="image/png" href="../img/favicomatic/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="../img/favicomatic/favicon-16x16.png" sizes="16x16" />
<link rel="stylesheet" href="">
</head>
<body>
	<!-- Sostituire con tag HTML5 <header>? Vedere pro e contro
		Contro: XHTML5 non esiste -> in xhtml i tag header e footer non esistono.

	-->
	<div class="nav" id="nav">
		<div class="nav__logo-container" id="nav__logo-container">
			<a href=""> 
				<img src="../logo/logo_TVhunter.png" alt="logo del sito, riporta alla homepage">		
			</a>
		</div>
		
		<div class="nav__ricerca">
			<input type="text" placeholder="Search..">
		</div>
		
		<ul class="nav__top-list list_no-style	" id="nav__top-list">
			<li class="nav__esplora"><a href="" title="Esplora">Esplora</a></li>
			<li class="nav__restricted nav__profilo"><a href="" title="Profilo">Profilo</a></li>
			<li class="nav__restricted nav__preferiti"><a href="" title="Preferiti">Preferiti</a></li>
		</ul>

		<ul class="nav__bottom-list list_no-style">
			<li class="nav__restricted nav__impostazioni"><a href="" title="Impostazioni">Impostazioni</a></li>
			<li class="nav__faq"><a href=""><acronym title="Frequently Asked Questions">FAQ</acronym></a></li>
			<li class="nav__supporto"><a href="" title="Supporto">Supporto </a></li>
			<li class="nav__privacy"><a href="" title="Privacy"><span xml:lang="EN">Privacy</span></a></li>
			<li class="nav__about"><a href="" title="About"><span xml:lang="EN">About</span></a></li>
   		</ul>

		<div class="nav__social">
		</div>
		<div class="nav__icon">
			<a href="javascript:void(0);" onclick="myFunction()"><i class=""></i>Pulsante</a> <!-- TODO: aggiungere pulsante icons -->
		</div>

	</div>

	<div class="page-center"><!-- TODO: aggiungere spaziatura tra div e far vedere la navbar -->
		<div class="header">
			<div class="header-content">
				<h1>TV Hunter</h1>
			</div>
		</div>
		<div id="login" class="content">	
    		 <div id="login__top" class="login">
                <form action="login_action.php">
                    <div class="login__riga">
                      <h2>Effettua il <span xml:lang="EN">login</span> con un social a scelta oppure manualmente</h2>
                                          
                      <div class="login__colonna">
                        <a  href="javascript:void(0);" class="fb btn" onclick="loginSocial()">
                          <i class="fa fa-facebook fa-fw"></i><span xml:lang="EN">Login</span> con <span xml:lang="EN">Facebook</span><!-- TODO: aggiungere icona social -->
                        </a>
                        <a href="javascript:void(0);" class="twitter btn" onclick="loginSocial()">
                          <i class="fa fa-twitter fa-fw"></i><span xml:lang="EN">Login</span> con <span xml:lang="EN">Twitter</span><!-- TODO: aggiungere icona social -->
                        </a>
                        <a href="javascript:void(0);" class="google btn" onclick="loginSocial()">
                          <i class="fa fa-google fa-fw"></i><span xml:lang="EN">Login</span> con <span xml:lang="EN">Google+</span><!-- TODO: aggiungere icona social -->
                        </a>
                      </div>
                    
                      <div class="login__colonna">
                        <!-- div class="hide-md-lg">
                          <p>Or sign in manually:</p>
                        </div>
                     -->
                        <input type="text" name="username" placeholder="Username" required>
                        <input type="password" name="password" placeholder="Password" required>
                        <input type="submit" value="Login">
                      </div>
                    
                    </div>
                </form>
    		</div>
    
            <div class="bottom-container">
              <div class="login__riga">
                <div class="login__colonna">
                  <a href="signup.php" style="color:white" class="btn"><span xml:lang="EN">Sign up</span></a>
                </div>
                <div class="login__colonna">
                  <a href="#" style="color:white" class="btn">Forgot password?</a>
                </div>
              </div>
            </div> 
         </div>
	</div>

	<div class="footer">
		<div class="footer__nav">
			<ul class="list_no-style">
				<li><a href="">Supporto </a></li>
				<li><a href=""><span xml:lang="EN">Privacy</span></a></li>
				<li><a href="">About</a></li>
			</ul>	
		</div>
	</div>

	
<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <a href="javascript:void(0);" onclick="closeModal()"><span class="close">&times;</span></a>
    <p>Siamo spiacenti ma la funzione di <span xml:lang="EN">login</span> tramite <spanxml:lang="EN">social</span> verr&agrave;  introdotta nelle versioni successive</p>
  </div>

</div>

<script>
var modal = document.getElementById('myModal');

function myFunction() {
    var x = document.getElementById("nav");
    var y = document.getElementById("nav__top-list");
    var z = document.getElementById("nav__logo-container");


    if (x.className === "nav") {
        x.className += " responsive";
        y.className += " responsive";
        z.className += " responsive";
    } else {
        x.className = "nav";
        y.className = "nav__top-list";
        z.className = "nav__logo-container";
    }
}
/*TODO: aggiustare il modal*/
function loginSocial(){
	modal.style.display = "block";
}
function closeModal(){
	modal.style.display = "none";
}
//When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


</script>

</body>
</html>


